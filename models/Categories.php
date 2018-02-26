<?php 
class Categories
{
	public static function getCategoriesList()
	{

		$db = DB::getConnection();
		$categoryList = array();

		$result = $db->query('SELECT * FROM category');


		$i = 0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$categoryList[$i]['id'] = $row['id'];
			$categoryList[$i]['icon'] = $row['icon'];
			$categoryList[$i]['name'] = $row['name'];
			$categoryList[$i]['en_name'] = $row['en_name'];
			$i++;
		}
		return $categoryList;
	}
}
?>