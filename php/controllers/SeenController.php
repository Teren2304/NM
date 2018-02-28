<?php 
include_once '../models/Seen.php';
class SeenController
{
	public function actionIndex()
	{	
		$category = $_GET['c'];
		$id = $_POST['id'];
		$seen = $_POST['seen'];
		Seen::getSeenList($category, $id, $seen);
	}
}
$news = new SeenController();
$news->actionIndex();
?>