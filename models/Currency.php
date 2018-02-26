<?php 
class Currency
{
	public function getCurrencyList()
	{
		$db = DB::getConnection();
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