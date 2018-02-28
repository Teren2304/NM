<?php 
include_once '../models/News.php';
class NewsController
{
	public function actionIndex()
	{	
		//?c=add&o=0&t=week&s=2018
		$category = $_GET['c'];
		$offset = $_GET['o'];
		$time = $_GET['t'];
		$search = $_GET['s'];

		$news = array();
		$news = News::getNewsList($category, $offset, $time, $search);
		echo json_encode($news, JSON_UNESCAPED_UNICODE);
		return true;
	}
}
$news = new NewsController();
$news->actionIndex();
?>