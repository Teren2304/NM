<?php 
include_once('../models/CurrencyWeather.php');
class GetCurrencyWeatherController
{
	public function actionIndex()
	{	    
		$currency = array();
		$currency = CurrencyWeather::Get();
		echo json_encode($currency, JSON_UNESCAPED_UNICODE);
		return true;
	}
}
$currency = new GetCurrencyWeatherController();
$currency->actionIndex();
?>