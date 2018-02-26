<?php 


include_once ROOT.'/models/News.php';

class NewsController
{
	public function actionIndex($category, $offset, $time, $search)
	{	    

		$news = array();
		$news = News::getNewsList($category, $offset, $time, $search);




		echo json_encode($news, JSON_UNESCAPED_UNICODE);
		return true;
	}
}


?>