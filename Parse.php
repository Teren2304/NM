<?php

class Db
{
	public static function getConnection()
	{
		$paramsPath = 'config/db_params.php';
		$params = include($paramsPath);
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		$db = new PDO($dsn, $params['user'], $params['password']);
		$db->exec("set names utf8");
		return $db;
	}
}



class Parse
{	
	private $db;
	private $all_data;
	private $newsCount;
	function __construct()
	{
		$this->db = Db::getConnection();
        $this->all_data = array();
        $this->count = array();
	}

	private function selectDataSource($query)
	{
		$result = $this->db->query($query);
		$i = 0;
		while ($row = $result->fetch()) {
			if ($row['status'] == 1) {
				$this->all_data[$i]['id'] = $row['id'];
				$this->all_data[$i]['name'] = $row['name'];
				$this->all_data[$i]['link_source'] = $row['link_source'];
				$this->all_data[$i]['link_rss'] = $row['link_rss'];
				$this->all_data[$i]['icon'] = $row['icon'];
				$this->all_data[$i]['category'] = $row['category'];
				$this->all_data[$i]['status'] = $row['status'];
			}
			$i++;
		}
		print_r($this->all_data);
	}

	private function selectNews($query)
	{
		$result = $this->db->query($query);
		$row = $result->fetch();
		return $row[0];
	}

	private function selectValue(){
        $this->selectDataSource("SELECT * FROM `source`");
    }

    public function parseItem()
    {
    	$this->selectValue();
    	foreach ($this->all_data as $value) {

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
						$wrongNews = $this->selectNews("SELECT COUNT(*) FROM `".$category."` WHERE `news_link` = '".$link."'");

						if ($item->description == null) {
							$item->description = $item->title;}



						$array = array('<p>', '</p>', '"', '<br clear=all>');
						$item->title = str_replace( $array, "", $item->title);
						$item->description = str_replace( $array, "", $item->description);
						$item->title = htmlspecialchars_decode($item->title, ENT_NOQUOTES);
						$item->description = htmlspecialchars_decode($item->description, ENT_NOQUOTES);

						if ($wrongNews == 0) {
							$result = $this->db->query("INSERT INTO `".$category."`(
								`news_title`, 
								`news_link`, 
								`news_date`, 
								`news_source_link`,
								`news_source_img`,
								`news_description`,
								`news_img`) VALUES (
								'".$item->title."',
								'".$link."',
								'".date_create($item->pubDate)->Format('Y-m-d H:i:s')."',
								'".$value['link_source']."',
								'img/source/".$value['icon']."',
								'".$item->description."',
								'".$img['url']."'
							)");
						}

						//print_r($value['icon']);
						/*print_r ('{
							"news_title": "'.str_replace("\"","",$item->title).'",
							"news_link": "'.$link.'",
							"news_date": "'.date_create($item->pubDate)->Format('Y-m-d H:i:s').'",
							"name_source": "'.$value['name'].'",
							"news_source_link": "'.$source_url.'",
							"news_source_img": "img/source/'.$value['icon'].'",
							"news_description": "'.str_replace("\"","", $item->description).'",
							"news_img":  "'.$img['url'].'",
							"news_category":  "'.$value['category'].'"
						}');*/
						$link = '';
						$category = '';
				}
    		}
    		else{
    			echo $value['link_rss'].'- not loaded';
    		}
    	}
    }
}



$parse = new Parse();
$parse -> parseItem();
?>
