<?php 
include_once ROOT.'/models/Currency.php';
class CurrencyController
{
	public function actionIndex()
	{	    
		$currency = array();
		$currency = Currency::getCurrencyList();
		echo json_encode($currency, JSON_UNESCAPED_UNICODE);
		return true;
	}
}
?>