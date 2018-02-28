<?php
error_reporting(0);
include_once('../components/Db.php');
class Seen
{
	public function getSeenList($category, $id, $seen)
	{
		$db = DB::getConnection();
		$insert = $db->query('UPDATE `'.$category.'` SET seen = '.++$seen.' WHERE id='.$id.'');

		/*if (!empty($id) AND !empty($seenNewsSeen) ) {	
		}
		else{
			header("Location: http://news-market.info");
		}*/
	}
}
?>
