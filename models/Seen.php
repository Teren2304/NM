<?php
error_reporting(0);
class Seen
{
	public function getSeenList($category)
	{
		$db = DB::getConnection();
		$seenNews = array();
		$id = $_POST['id'];
		$seenNewsSeen = $_POST['seen'];

		$insert = $db->query('UPDATE `'.$category.'` SET seen = '.++$seenNewsSeen.' WHERE id='.$id.'');


	/*	if (!empty($id) AND !empty($seenNewsSeen) ) {
			
		}
		else{
			header("Location: http://news-market.info");
		}*/
		
	}
}
?>
