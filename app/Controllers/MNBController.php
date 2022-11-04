<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;
use Exception;

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
        $data = ['curr1' => '',
                    'curr2' => '',
                    'unit1' => '',
                    'unit2' => '',
                    'rate1' => '',
                    'rate2' => '',
                    'curr1Error' => '',
                    'curr2Error' => '',
                    'rate1Error' => '',
                    'rate2Error' => ''];

        return $this->view('mnb', [
			'data' => $data
		]);
    }

    /* Get exchange rates between two currencies */
    /**
	 * @return mixed
	 */
    public function GetExchangeRates()
    {
        $data = ['curr1' => '',
                    'curr2' => '',
                    'unit1' => '',
                    'unit2' => '',
                    'rate1' => '',
                    'rate2' => '',
                    'curr1Error' => '',
                    'curr2Error' => '',
                    'rate1Error' => '',
                    'rate2Error' => ''];

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = ['curr1' => trim($_POST['curr1']),
                        'curr2' => trim($_POST['curr2']),
                        'unit1' => '',
                        'unit2' => '',
                        'rate1' => '',
                        'rate2' => '',
                        'curr1Error' => '',
                        'curr2Error' => '',
                        'rate1Error' => '',
                        'rate2Error' => ''];

            /* Validating inputs */
            $currencieValidation = "/^[A-Z]*$/";

            if(empty($data['curr1']))
            {
                $data['curr1Error'] = 'Please specify from which currency do you want to convert.';
            }
            elseif(!preg_match($currencieValidation, $data['curr1']) || strlen($data['curr1']) != 3)
            {
                $data['curr1Error'] = 'Invalid currency! Please try again. (e.g.: HUF, EUR)';
            }
            elseif(!$this->ValidateCurrencies($data['curr1']))
            {
                $data['curr1Error'] = $data['curr1'] . ' currency is not in our databanks. Please try another one.';
            }

            if(empty($data['curr2']))
            {
                $data['curr2Error'] = 'Please specify to which currency do you want to convert.';
            }
            elseif(!preg_match($currencieValidation, $data['curr2']) || strlen($data['curr2']) != 3)
            {
                $data['curr2Error'] = 'Invalid currency! Please try again. (e.g.: HUF, EUR)';
            }
            elseif(!$this->ValidateCurrencies($data['curr2']))
            {
                $data['curr2Error'] = $data['curr2'] . ' currency is not in our databanks. Please try another one.';
            }

            /* If everything is ok we search for the exchange rates */
            if(empty($data['curr1Error']) && empty($data['curr2Error']))
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
                    var_dump($e);
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
                    $data['rate1Error'] = 'There are no information about the ' . $data['curr1'] . ' currency at this date.';
                }
                if($rate2 == 0)
                {
                    $data['rate2Error'] = 'There are no information about the ' . $data['curr2'] . ' currency at this date.';
                }

                /* If we got both exchange rates we calculate the exchange rate between the two currencies */
                if(empty($data['rate1Error']) && empty($data['rate2Error']))
                {
                    $f_unit1 = floatval($unit1);
                    $f_unit2 = floatval($unit2);
                    $f_rate1 = floatval($rate1);
                    $f_rate2 = floatval($rate2);

                    if($data['curr1'] == "HUF")
                    {
                        $data['unit1'] = $unit2;
                        $data['rate1'] = $rate2;
                        $data['unit2'] = $unit1;
                        $data['rate2'] = $f_unit2 / $f_rate2;
                    }
                    elseif($data['curr2'] == "HUF")
                    {
                        $data['unit1'] = $unit2;
                        $data['rate1'] = $f_unit1 / $f_rate1;
                        $data['unit2'] = $unit1;
                        $data['rate2'] = $rate1; 
                    }
                    else
                    {
                        $data['unit1'] = $unit1;
                        $data['rate1'] = ($f_unit1 / $f_rate1 * $f_unit1) * ($f_rate2 / $f_unit2);
                        $data['unit2'] = $unit2;
                        $data['rate2'] = ($f_unit2 / $f_rate2 * $f_unit2) * ($f_rate1 / $f_unit1);
                    }
                }
            }
        }
        else
        {
            $data = ['curr1' => '',
                        'curr2' => '',
                        'unit1' => '',
                        'unit2' => '',
                        'rate1' => '',
                        'rate2' => '',
                        'curr1Error' => '',
                        'curr2Error' => '',
                        'rate1Error' => '',
                        'rate2Error' => ''];
        }

        return $this->view('mnb', $data);
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
            var_dump($e);
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