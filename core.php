<?php
	/*
		Core file, a rendszer magja
		Készítette: Tóth István
	*/

	session_start();
	/*AZ SQL KAPCSOLODÁS*/
	require_once __DIR__ . "/pdo.php";
	$sql = new sql();
	if(!$sql->set_connection_data("localhost",3306,"tE25xISZE","trt88xy5","tE25xISZE")){
		die('Nem sikerült beállítani az adatokat!');
	}else{
		if(!$sql->make_sql_connection()){
			die('Sikertelen SQL kapcsolodás!<br>');
		}
	}
	require_once __DIR__ ."/users.php";

	function letszamszamolo($classid,$free){ //Ez azért felelős, hogy meghatározza a létszámot egy-egy osztályban, kapcsolható a 2. változóval, hogy csak az ingyeneseket vagy csak a fizetősöket számolja
			if($free){
				$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM diakok WHERE Ingyenes LIKE '%I%' AND Osztaly='".$classid."'");
				$sth->execute();
				return $sth->rowCount(); //visszaadja a lekérdezésből akpott sorok számát
			}else{
				$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM diakok WHERE Ingyenes LIKE '%N%' AND Osztaly='".$classid."'");
				$sth->execute();
				return $sth->rowCount();//visszaadja a lekérdezésből akpott sorok számát
			}
	}

	function get_global_state(){ //meghatározza a stádiumot
			$tanulo = 0;
			$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM osztalyok WHERE lezarva='0'");
			$sth->execute();
			if($sth->rowCount() == 0){
				//ha nincs olyan osztály aki nincs lezárva akkor továbblép
				$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM diakok WHERE lezarva='0'");
				$sth->execute();
				if($sth->rowCount() == 0){
					//ha nincs olyan diak aki nincs lezarva akkor a végső stádiumban van
					return 3;
				}else{
					//ha van olyan diak aki még nincs lezárva kkor cska  2. stádiumban van
					return 2;
				}
			}else{
				//ha van olyan osztaly ami nincs lezarva kkor meg csak az 1. stádium van.
				return 1;
			}
	}

	function find_konyv_data($Rakt_szam,$data){ //a kapott paraméterekből a könyvek táblából kéri le az adatot
		$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM konyvek WHERE Rakt_szam='".$Rakt_szam."'");
		$sth->execute();
		$konyv = $sth->fetch();
		return $konyv["".$data.""];
	}

	function HowManyBookWheHave($book){ //meghatározza mennyi könyv kell
		$konyvkell = 0;
		$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM csomagok WHERE raktarszam='".$book."' ORDER BY id ASC");
		$sth->execute();
		/*lekérdezem a csomagokat melyekben az adott könyv szerepel*/
		while($csomag = $sth->fetch()){
			/*Megszámolom ez a könyv hány diáknak kell*/
			$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM diakok WHERE Osztaly='".$csomag['osztaly']."' ORDER BY Osztaly ASC");
			$sth->execute();
			while($diak = $sth->fetch()){
				if(IsStudentNeedThis($diak["Diakkod"],$book)){  //itt leellenörzöm, hogy az osztály tagjának valóban szüksége van e a könyvre
					$konyvkell = $konyvkell+1;
				}
			}		
		}
		return $konyvkell;
	}

	function HowManyBookWeNeedWithoutFree($book){ //mennnyi könyvre van szükség ha az ingyeneseket nem nézzük.
		$konyvkell = 0;
		$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM csomagok WHERE raktarszam='".$book."' ORDER BY id ASC");
		$sth->execute();
		while($csomag = $sth->fetch()){
			$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM diakok WHERE Osztaly='".$csomag['osztaly']."' ORDER BY Osztaly ASC");
			$sth->execute();
			while($diak = $sth->fetch()){
				if(IsStudentNeedThis($diak["Diakkod"],$book)){
					if($diak["Ingyenes"] == "N"){
						$konyvkell = $konyvkell+1;
					}
				}
			}		
		}
		return $konyvkell;
	}

	function IsStudentNeedThis($student,$lang){ //leelenörzi, hogy a diáknak kell a könyv
				if($lang == "Angol" || $lang == "Német" || $lang=="Francia" || $lang=="Orosz"){ //ha nyelvi tárhy akkor továbbmegy
					$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM diakok WHERE Diakkod='".$student."'");
					$sth->execute();
					$felhasznalo = $sth->fetch();
					/*Megnézi, hogy a diák tanulja-e a nyelvet*/
					if($felhasznalo["Nyelv1"] == $lang && $felhasznalo["Nyelv1"] != "-"){
						return true; //ha a nyelv1 azonos akkor kell neki
					}elseif($felhasznalo["Nyelv2"] == $lang && $felhasznalo["Nyelv2"] != "-"){
						return true; //ha a nyelv2 azonos akkor kell neki
					}else{
						return false; //ha egyik sem akkor nem kell neki
					}
				}else{
					return true; //ha nem nyelvi könyv akkor kell neki
				}
			}

	if(isUserLogged() && isset($_SESSION['permission'])){
		if($_SESSION['permission'] == 1){
			function IsItMyLanguage($lang){ //megvizsgálom, hogy ez a diák tanulja-e ezt a nyelvet
				if($lang == "Angol" || $lang == "Német" || $lang=="Francia" || $lang=="Orosz"){ //megállapítom, hogy a kapott tárgy az nyelv
					$sth = $GLOBALS['sql']->sql_connect->prepare("SELECT * FROM diakok WHERE Diakkod='".$_SESSION['username']."'");
					$sth->execute();
					$felhasznalo = $sth->fetch();

					if($felhasznalo["Nyelv1"] == $lang && $felhasznalo["Nyelv1"] != "-"){
						return true; //ha a nyelv1-el azonos akkor tanulja
					}elseif($felhasznalo["Nyelv2"] == $lang && $felhasznalo["Nyelv2"] != "-"){
						return true; //ha a nyelv2-vel azonos akkor tanulja
					}else{
						return false; //ha nem azonos akkor nem tanulja
					}
				}else{
					return true; //ha nem nyelv akkor tuti tanulja
				}
			}
		}
	}

	function getSelectedColor($lvl){ //a funkció a permission levelnek megfelelő színt adja vissza.
		if($lvl == 1){
				$color = "#22943f"; //diak login eseten zold
			}elseif($lvl == 2){
				$color = "#b48d23"; //tanar login eseten barnassarga
			}elseif($lvl == 3){
				$color = "#22943f"; //konyvtaros login eseten zold
			}elseif($lvl == 4){
				$color = "#1e543f"; //munkavezeto login eseten zold
			}elseif($lvl == 5){
				$color = "#b43f23"; //vezetoseg login eseten pirosassarga
			}else{
				$color = "#fff";
			}

		return $color;
	}

?>