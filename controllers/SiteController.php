<?php 
class SiteController
{
	public function actionIndex()
	{
		require_once(ROOT.'/view/news-market/index.php');
		return true;
	}
}
?>