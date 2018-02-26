<?php 
include_once ROOT.'/models/Seen.php';
class SeenController
{
	public function actionIndex($category)
	{	    
		$news = array();
		$news = Seen::getSeenList($category);
		return true;
	}
}
?>