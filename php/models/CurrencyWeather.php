<?php
include_once('../components/Db.php');
class CurrencyWeather
{	
	private function Curl($link){
		$curl = curl_init($link);
		if ( $curl )
		{
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
			$page = curl_exec($curl);
			curl_close($curl);
			unset($curl);
			$xml = new SimpleXMLElement($page);	
			return $xml;	
		}
	}
	private function Weather(){
		$xml = $this->Curl("http://www.eurometeo.ru/ukraina/kiyvska-oblast/kiyiv/export/xml/data/");
		return $xml->city->step[0]->temperature;
	}
	private function Currency(){
		$xml = $this->Curl("https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5");
		return array(
			'USD_buy' => $xml->row[0]->exchangerate['buy'][0],
			'USD_sale' => $xml->row[0]->exchangerate['sale'][0],
			'EUR_buy' => $xml->row[1]->exchangerate['buy'][0],
			'EUR_sale' => $xml->row[1]->exchangerate['sale'][0],
			'RUR_buy' => $xml->row[2]->exchangerate['buy'][0],
			'RUR_sale'  => $xml->row[2]->exchangerate['sale'][0],
			'Bitcoin_buy' => $xml->row[3]->exchangerate['buy'][0],
			'Bitcoin_sale' => $xml->row[3]->exchangerate['sale'][0]
		);
	}
    public function Parse(){
    	$db = DB::getConnection();
    	$currency = $this->Currency();
    	$weather = $this->Weather();

    	if ($currency['USD_buy']!=null && $currency['USD_sale']!=null && $currency['EUR_buy']!=null && $currency['EUR_sale']!=null && $currency['RUR_buy']!=null && $currency['RUR_sale']!=null && $currency['Bitcoin_buy']!=null && $currency['Bitcoin_sale']!=null && $weather!=null) {
			$result = $db->query("UPDATE `currency_weather` SET
				`EUR_sale` 		= '".$currency['EUR_sale']."',
				`EUR_buy` 		= '".$currency['EUR_buy']."',
				`USD_sale` 		= '".$currency['USD_sale']."',
				`USD_buy` 		= '".$currency['USD_buy']."',
				`RUR_sale` 		= '".$currency['RUR_sale']."',
				`RUR_buy`		= '".$currency['RUR_buy']."',
				`Bitcoin_sale` 	= '".$currency['Bitcoin_sale']."', 
				`Bitcoin_buy` 	= '".$currency['Bitcoin_buy']."',
				`weather` = '".$weather."' WHERE `id` = '1'");
		}
    }
	public function Get()
	{
	    $db = Db::getConnection();
		$currency = array();
		$result = $db->query("SELECT * FROM `currency_weather` ORDER BY id DESC LIMIT 1");
		$i = 0;
	        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	              $currency[$i]['id'] = $row['id'];
	              $currency[$i]['EUR_sale'] = str_replace(".", ",", $row['EUR_sale']);
	              $currency[$i]['EUR_buy'] = str_replace(".", ",", $row['EUR_buy']);
	              $currency[$i]['USD_sale'] = str_replace(".", ",", $row['USD_sale']);
	              $currency[$i]['USD_buy'] = str_replace(".", ",", $row['USD_buy']);
	              $currency[$i]['RUR_sale'] = str_replace(".", ",", $row['RUR_sale']);
	              $currency[$i]['RUR_buy'] = str_replace(".", ",", $row['RUR_buy']);
	              $currency[$i]['Bitcoin_sale'] = str_replace(".", ",", $row['Bitcoin_sale']);
	              $currency[$i]['Bitcoin_buy'] = str_replace(".", ",", $row['Bitcoin_buy']);
	              $currency[$i]['weather'] = round($row['weather'], 0);
	              $i++;
		}
		return $currency;
	}
}
?>