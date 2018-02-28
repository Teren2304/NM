<?php
include_once('../components/Db.php');
class ParseNews
{	
	private $db;
	private $source;
	private $newsCount;


	function __construct()
	{
		$this->db = Db::getConnection();
        $this->source = array();
        $this->count = array();
	}

	private function selectDataSource($query)
	{
		$result = $this->db->query($query);
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			if ($row['status'] == 0) {
				array_push($this->source, $row);
			}
		}
		print_r($this->source);
	}

	private function selectNews($query)
	{
		$result = $this->db->query($query);
		$row = $result->fetch();
		return $row[0];
	}

    public function parseItem()
    {
    	$this->selectDataSource("SELECT * FROM `source`");
    	foreach ($this->source as $value) {
    		$rss = simplexml_load_file($value['link_rss']);
    		if ($rss) {
    				foreach ($rss->channel->item as $item) {
						$link = $item->link;
						$img = $item->enclosure;

						switch ($value['category']) {
							case 'politic': $category = 'politic'; break;
							case 'economy': $category = 'economy'; break;
							case 'technology': $category = 'technology'; break;
							case 'world': $category = 'world'; break;
							case 'auto': $category = 'auto'; break;
							case 'sport': $category = 'sport'; break;
							case 'all': $category = 'all'; break;
							default: $category = 'all'; break;
						}

						$news_video = null;
						if ($item->description == null || $item->description = '') {
							$item->description = $item->title;
						}
						if (preg_match("/.mp4/", $img['url'])) {
						   $news_video = 1;
						} 

						
						$repeat = $this->selectNews("SELECT COUNT(*) FROM `".$category."` WHERE `news_link` = '".$link."'");
						$clear = array('<p>', '</p>', '"', '<br clear=all>');
						$item->title = str_replace( $clear, "", $item->title);
						$item->description = str_replace( $clear, "", $item->description);
						$item->title = htmlspecialchars_decode($item->title, ENT_NOQUOTES);
						$item->description = htmlspecialchars_decode($item->description, ENT_NOQUOTES);


						


						if ($repeat == 0) {
							$result = $this->db->query("INSERT INTO `".$category."`(
								`news_title`, 
								`news_link`, 
								`news_date`, 
								`news_source_link`,
								`news_source_img`,
								`news_description`,
								`news_img`,
								`news_video`) VALUES (
								'".$item->title."',
								'".$link."',
								'".date_create($item->pubDate)->Format('Y-m-d H:i:s')."',
								'".$value['link_source']."',
								'img/source/".$value['icon']."',
								'".$item->description."',
								'".$img['url']."',
								'".$news_video."'
							)");
						}
						$link = '';
						$category = '';
						$news_video = null;
				}	
    		}
    		else{
    			echo $value['link_rss'].'- not loaded';
    		}
    	}
    }
}



$parse = new ParseNews();
$parse->parseItem();
?>
