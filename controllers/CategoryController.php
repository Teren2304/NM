<?php 
include_once ROOT.'/models/Categories.php';
class CategoryController
{
	public function actionIndex()
	{
		$categories = array();
		$categories = Categories::getCategoriesList();
		echo json_encode($categories, JSON_UNESCAPED_UNICODE);
		return true;
	}
}
?>