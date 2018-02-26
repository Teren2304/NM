<?php 

include_once ROOT.'/models/Source.php';

class SourceController
{
	public function actionIndex()
	{

		$source = array();
		$source = Source::getSourceList();
		
		//print_r($source);

		require_once(ROOT.'/view/news-market/source.php');
		return true;
	}
}



?>