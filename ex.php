<?php


//require_once "include_php/dbConfig.php";

require_once "include_php/Db.php";

class insertData
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
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			if ($row['status'] == 1) {
				$this->all_data[$i]['id'] = $row['id'];
				$this->all_data[$i]['name'] = $row['name'];
				$this->all_data[$i]['icon'] = $row['icon'];
				$this->all_data[$i]['link'] = $row['link'];
				$this->all_data[$i]['status'] = $row['status'];
				$this->all_data[$i]['category'] = $row['category'];
			}
			$i++;
		}
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
    		
			//error_reporting(0);
    		$rss = simplexml_load_file($value['link']);
    		if ($rss) {
    				foreach ($rss->channel->item as $item) {
						$img = $item->enclosure;
						$link = $item->link;
						$source = parse_url($value['link'], PHP_URL_HOST);
						$source_url = parse_url($value['link'], PHP_URL_SCHEME).'://'.$source;
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

						if ($item->description == null || $item->description == '') {
							$item->description = $item->title;
						}

						$array = array('<p>', '</p>', '"', '<br clear=all>');
						//$item->title = str_replace( $array, "", $item->title);
						//$item->description = str_replace( $array, "", $item->description);


						$item->title = htmlspecialchars_decode($item->title, ENT_NOQUOTES);
						$item->description = htmlspecialchars_decode($item->description, ENT_NOQUOTES);
						$item->title = str_replace( $array, "", $item->title);
						$item->description = str_replace( $array, "", $item->description);

						$item->description = preg_replace ('/<img.*>/Uis', '', $item->description);
						

			            if ($value['name'] == 'Автопортал') {
			                $source_url = 'http://autoportal.ua';
			            }
			            if ($value['name'] == 'Уніан') {
			                $source_url = 'http://unian.net';
			            }
			            if ($value['name'] == 'КорреспонденT.net') {
			                $source_url = 'https://korrespondent.net';
			            }
/*
			            $var_img = substr($img['url'], strrpos($img['url'], '.') + 1);
			            if ($var_img == 'mp4') {
			            	$img['url'] = '';
			            }*/

						if ($wrongNews == 0) {
							$result = $this->db->query("INSERT INTO `".$category."`(
								`news_title`, 
								`news_link`, 
								`news_date`, 
								`name_source`,
								`news_source_link`,
								`news_source_img`,
								`news_description`,
								`news_img`) VALUES (
								'".$item->title."',
								'".$link."',
								'".date_create($item->pubDate)->Format('Y-m-d H:i:s')."',
								'".$value['name']."',
								'".$source_url."',
								'img/source/".$value['icon']."',
								'".$item->description."', 
								'".$img['url']."'
							)");
						}
						
				
					   


						/*
							print_r ('{
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
				echo $value['link'].'<br>';
    		}
    		else{
    			echo $value['link'].'- not loaded';
    		}
    	}
    }
}

$select = new insertData();
$select->parseItem();









/*
$select = new insertData();
$i = 0;
while (1) {
	$i++;
	echo $i;
	$select->parseItem();
	sleep(300); 
}*/


				
				

/*
$urls = [
'http://news.liga.net/top/rss.xml',
'http://news.liga.net/economics/rss.xml', 
'http://news.liga.net/sport/rss.xml',
'https://censor.net.ua/includes/news_ru.xml',
'http://www.aif.ua/rss/all.php',
'http://podrobnosti.ua/rss/feed/?category=all-news',
'http://podrobnosti.ua/rss/feed/?category=tehno',
'http://podrobnosti.ua/rss/feed/?category=dengi',
'http://podrobnosti.ua/rss/feed/?category=vlast'
];


$multi = curl_multi_init();
$handles = [];

foreach ($urls as $url) 
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	curl_multi_add_handle($multi, $ch);
	$handles[$url] = $ch;

	$rss = simplexml_load_file($url);
   	if ($rss) 
   	{
   		foreach ($rss->channel->item as $item) 
   		{
				$img = $item->enclosure;
				$link = $item->link;
				print_r ('{
					"news_title": "'.str_replace("\"","",$item->title).'",
					"news_date": "'.date_create($item->pubDate)->Format('Y-m-d H:i:s').'",
					"news_description": "'.str_replace("\"","", $item->description).'",
					"news_img":  "'.$img['url'].'"
				}');
		}
   	}
   	else
   	{
   		echo 'Not loaded';
   	}
}

do 
{
	$mrc = curl_multi_exec($multi, $active);
} while ( $mrc == CURLM_CALL_MULTI_PERFORM);


while ($active && $mrc == CURLM_OK) 
{
	if (curl_multi_select($multi) == -1) {
		usleep(100);
	}
	do 
	{
		$mrc = curl_multi_exec($multi, $active);
	} while ( $mrc == CURLM_CALL_MULTI_PERFORM);
}



foreach ($handles as $channel) {

	//$html = curl_multi_getcontent($channel);
	//print_r($channel);
	//var_dump($html);
	curl_multi_remove_handle($multi, $channel);
}
curl_multi_close($multi);



*/




?>
