<?php
require_once "include_php/Db.php";
class insertData
{	
	private $db;
	function __construct()
	{
		$this->db = Db::getConnection();
	}

	public function curl($link){
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
		$xml = $this->curl("http://www.eurometeo.ru/ukraina/kiyvska-oblast/kiyiv/export/xml/data/");
		$weather = $xml->city->step[0]->temperature;	
		return $weather;
	}


	private function Currency(){
		$xml = $this->curl("https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5");
		$USD_buy = $xml->row[0]->exchangerate['buy'][0];
		$USD_sale = $xml->row[0]->exchangerate['sale'][0];
		$EUR_buy = $xml->row[1]->exchangerate['buy'][0];
		$EUR_sale = $xml->row[1]->exchangerate['sale'][0];
		$RUR_buy = $xml->row[2]->exchangerate['buy'][0];
		$RUR_sale  = $xml->row[2]->exchangerate['sale'][0];
		$Bitcoin_buy = $xml->row[3]->exchangerate['buy'][0];
		$Bitcoin_sale = $xml->row[3]->exchangerate['sale'][0];

		$weather = $this->Weather();
		if ($USD_buy!=null && $USD_sale!=null && $EUR_buy!=null && $EUR_sale!=null && $RUR_buy!=null && $RUR_sale!=null && $Bitcoin_buy!=null && $Bitcoin_sale!=null && $weather!=null) {
			$result = $this->db->query("UPDATE `currency_weather` SET
				`EUR_sale` = '".$EUR_sale."',
				`EUR_buy` = '".$EUR_buy."',
				`USD_sale` = '".$USD_sale."',
				`USD_buy` = '".$USD_buy."',
				`RUR_sale` = '".$RUR_sale."',
				`RUR_buy` = '".$RUR_buy."',
				`Bitcoin_sale` = '".$Bitcoin_sale."', 
				`Bitcoin_buy` = '".$Bitcoin_buy."',
				`weather` = '".$weather."' WHERE `id` = '1'");
		}
	}

    public function parseItem()
    {
    	$this->Currency();
    }
}
$select = new insertData();
$select->parseItem();
?>
