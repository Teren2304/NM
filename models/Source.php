<?php 
class Source
{
	public function getSourceList()
	{
		$db = DB::getConnection();
		$sourceList = array();
		$result = $db->query('SELECT * FROM `source`');
		//$i = 0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			/*$sourceList[$i]['id'] = $row['id'];
			$sourceList[$i]['name'] = $row['name'];
			$sourceList[$i]['link_source'] = $row['link_source'];
			$sourceList[$i]['link_rss'] = $row['link_rss'];
			$sourceList[$i]['img'] = $row['img'];
			$sourceList[$i]['category'] = $row['category'];
			$sourceList[$i]['status'] = $row['status'];
			$i++;*/
			array_push($sourceList, $row);
		}
		return $sourceList;
	}
}
?>
