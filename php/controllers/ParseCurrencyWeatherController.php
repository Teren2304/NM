<?php 
include_once('../models/CurrencyWeather.php');
class ParseCurrencyWeatherController
{
	public function actionIndex()
	{	    
		$parse = new CurrencyWeather();
		$parse->Parse();
		return true;
	}
}
$parse = new ParseCurrencyWeatherController();
$parse->actionIndex();
?>