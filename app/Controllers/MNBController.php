<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;
use Exception;
use SoapClient;

class MNBController extends Controller
{
    /* Private variables */
    private $client;

    /* Constructor */
    /**
	 * @param RouteCollection $routes
	 */
    public function __construct(RouteCollection $routes)
    {
        parent::__construct($routes);
    }

    /* Index function for opening the site */
    /**
	 * @return mixed
	 */
    public function index()
    {
        return $this->view('mnb');
    }

    /* Get exchange rates between two currencies */
    /**
	 * @return mixed
	 */
    public function GetExchangeRates()
    {
        $error = false;

        $data = [
			'curr1' => '',
			'curr2' => '',
			'unit1' => '',
			'unit2' => '',
			'rate1' => '',
			'rate2' => ''
		];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
				'curr1' => trim($_POST['curr1']),
				'curr2' => trim($_POST['curr2']),
				'unit1' => '',
				'unit2' => '',
				'rate1' => '',
				'rate2' => ''
			];

            /* Validating inputs */
            $currencieValidation = "/^[A-Z]*$/";

			try {
				if(empty($data['curr1']))
				{
					$error = true;
					Input::throwError('Please specify from which currency do you want to convert');
				}
				elseif(!preg_match($currencieValidation, $data['curr1']) || strlen($data['curr1']) != 3)
				{
					$error = true;
					Input::throwError('Invalid currency! Please try again. (e.g.: HUF, EUR)');
				}
				elseif(!$this->ValidateCurrencies($data['curr1']))
				{
					$error = true;
					Input::throwError($data['curr1'] . ' currency is not in our databanks. Please try another one');
				}

				if(empty($data['curr2']))
				{
					$error = true;
					Input::throwError('Please specify to which currency do you want to convert');
				}
				elseif(!preg_match($currencieValidation, $data['curr2']) || strlen($data['curr2']) != 3)
				{
					$error = true;
					Input::throwError('Invalid currency! Please try again. (e.g.: HUF, EUR)');
				}
				elseif(!$this->ValidateCurrencies($data['curr2']))
				{
					$error = true;
					Input::throwError($data['curr2'] . ' currency is not in our databanks. Please try another one');
				}
			} catch(Exception $e) {
				return $this->view('mnb', [
					'errors' => $e->getMessage()
				]);
			}

            /* If everything is ok we search for the exchange rates */
            if($error == false)
            {
                try
                {
                    $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
                    $result = simplexml_load_string($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);

                    $count = $result->Day[0]->count();

                    for($i = 0; $i <= $count - 1; $i++)
                    {
                        $j = 0;

                        foreach($result->Day[0]->Rate[$i]->attributes() as $a => $b)
                        {
                            $curexc_array[$i][$j] = $b->__toString();
                            $j = $j + 1;

                            if($j == 2)
                            {
                                $j = 0;
                            }
                        }
                        $curexc_array[$i][2] = $result->Day[0]->Rate[$i]->__toString();
                    }
                }
                catch (SoapFault $e)
                {
                    return $this->view('index', [
                        'errors' => $e->getMessage()
                    ]);
                }

                $rate1 = 0;
                $rate2 = 0;

                for($i = 0; $i <= $count - 1; $i++)
                {
                    if($data['curr1'] == "HUF")
                    {
                        $unit1 = 1;
                        $rate1 = 1;
                    }
                    else
                    {
                        if($curexc_array[$i][1] == $data['curr1'])
                        {
                            $unit1 = $curexc_array[$i][0];
                            $rate1 = $curexc_array[$i][2];
                        }
                    }
                    
                    if($data['curr2'] == "HUF")
                    {
                        $unit2 = 1;
                        $rate2 = 1;
                    }
                    else
                    {
                        if($curexc_array[$i][1] == $data['curr2'])
                        {
                            $unit2 = $curexc_array[$i][0];
                            $rate2 = $curexc_array[$i][2];
                        }
                    }
                }

                if($rate1 == 0)
                {
                    $error = true;
                    Input::throwError('There are no information about the ' . $data['curr1'] . ' currency at this date.');
                }
                if($rate2 == 0)
                {
                    $error = true;
                    Input::throwError('There are no information about the ' . $data['curr2'] . ' currency at this date.');
                }

                /* If we got both exchange rates we calculate the exchange rate between the two currencies */
                if($error == false)
                {
                    $f_unit1 = floatval($unit1);
                    $f_unit2 = floatval($unit2);
                    $f_rate1 = floatval($rate1);
                    $f_rate2 = floatval($rate2);

                    if($data['curr1'] == "HUF")
                    {
                        $div_rate = $f_unit2 / $f_rate2;
                        if($div_rate < 1)
                        {
                            $unit1 = 100;
                            $div_rate = $div_rate * 100;
                        }
                        $data['unit1'] = $unit2;
                        $data['rate1'] = round(floatval($rate2), 2);
                        $data['unit2'] = $unit1;
                        $data['rate2'] = round($div_rate, 2);
                    }
                    elseif($data['curr2'] == "HUF")
                    {
                        $div_rate = $f_unit1 / $f_rate1;
                        if($div_rate < 1)
                        {
                            $unit2 = 100;
                            $div_rate = $div_rate * 100;
                        }
                        $data['unit1'] = $unit2;
                        $data['rate1'] = round($div_rate, 2);
                        $data['unit2'] = $unit1;
                        $data['rate2'] = round(floatval($rate1), 2);
                    }
                    else
                    {
                        $div_rate1 = ($f_unit1 / $f_rate1 * $f_unit1) * ($f_rate2 / $f_unit2);
                        $div_rate2 = ($f_unit2 / $f_rate2 * $f_unit2) * ($f_rate1 / $f_unit1);
                        if($div_rate1 < 1)
                        {
                            $unit1 = 100;
                            $div_rate1 = $div_rate1 * 100;
                        }
                        if($div_rate2 < 1)
                        {
                            $unit2 = 100;
                            $div_rate2 = $div_rate2 * 100;
                        }
                        $data['unit1'] = $unit1;
                        $data['rate1'] = round($div_rate1, 2);
                        $data['unit2'] = $unit2;
                        $data['rate2'] = round($div_rate2, 2);
                    }
                }
            }
        }
        else
        {
            $data = [
				'curr1' => '',
				'curr2' => '',
				'unit1' => '',
				'unit2' => '',
				'rate1' => '',
				'rate2' => ''
			];
        }

        return $this->view('mnb', [
			'data' => $data
		]);
    }

    /* Function to validate input currencie */
    /**
     * @param strting $curr
	 * @return bool
	 */
    public function ValidateCurrencies($curr)
    {
        try
        {
            $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
            $result = json_decode(json_encode((array) simplexml_load_string($client->GetCurrencies()->GetCurrenciesResult)), 1);
            $cur_array = $result['Currencies'];
            $array = $cur_array['Curr'];
        }
        catch (SoapFault $e)
        {
            return $this->view('mnb', [
				'errors' => $e->getMessage()
			]);
        }

        if(in_array($curr, $array))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}