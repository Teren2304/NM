<?php
error_reporting(0);
ini_set( 'date.timezone', 'Europe/Kiev' ); 

class News
{
	const SHOW_BY_DEFAULT = 50;

	public function getNewsList($category='all', $offset=0, $time='minute', $search='')
	{
		$db = DB::getConnection();
		$newsList = array();
		$count = self::SHOW_BY_DEFAULT;
		$offset = $count * $offset;
		$dateTo = date("Y-m-d H:i:s");

		$a = $_POST['news_source_link'];
		




		$search = urldecode($search);







		switch ($time) {
            case "minute":
                $dateFrom = date('Y-m-d H:i:s', date("U")-600);
                if (!empty($a)) {
				    $result = $db->query("SELECT * FROM `".$category."`"
				        ."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."' AND `news_source_link` = '".$a."'"
				        ." 	ORDER BY `news_date` DESC"
				        ."  LIMIT ".$count.""
				        ."  OFFSET ".$offset."");
				}
				else{
					$result = $db->query("SELECT * FROM `".$category."`"
				   		."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."'"
				   		." 	ORDER BY `news_date` DESC"
				   		."  LIMIT ".$count.""
				   		."  OFFSET ".$offset."");
				}
                break;
            case "hours":
                $dateFrom = date('Y-m-d H:i:s', date("U")-3600);
              	if (!empty($a)) {
				    $result = $db->query("SELECT * FROM `".$category."`"
				        ."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."' AND `news_source_link` = '".$a."'"
				        ." 	ORDER BY `news_date` DESC"
				        ."  LIMIT ".$count.""
				        ."  OFFSET ".$offset."");
				}
				else{
					$result = $db->query("SELECT * FROM `".$category."`"
				   		."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."'"
				   		." 	ORDER BY `news_date` DESC"
				   		."  LIMIT ".$count.""
				   		."  OFFSET ".$offset."");
				}
                break;
            case "day":
                $dateFrom = date('Y-m-d H:i:s', date("U")-86400);
                if (!empty($a)) {
				    $result = $db->query("SELECT * FROM `".$category."`"
				        ."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."' AND `news_source_link` = '".$a."'"
				        ." 	ORDER `BY news_date` DESC"
				        ."  LIMIT ".$count.""
				        ."  OFFSET ".$offset."");
				}
				else{
					$result = $db->query("SELECT * FROM `".$category."`"
				   		."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."'"
				   		." 	ORDER BY `news_date` DESC"
				   		."  LIMIT ".$count.""
				   		."  OFFSET ".$offset."");
				}
                break;
            case "week":
                $dateFrom = date('Y-m-d H:i:s', date("U")-604800);
                if (!empty($a)) {
				    $result = $db->query("SELECT * FROM `".$category."`"
				        ."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."' AND `news_source_link` = '".$a."'"
				        ." 	ORDER BY `news_date` DESC"
				        ."  LIMIT ".$count.""
				        ."  OFFSET ".$offset."");
				}
				else{
					$result = $db->query("SELECT * FROM `".$category."`"
				   		."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$dateTo."'"
				   		." 	ORDER BY `news_date` DESC"
				   		."  LIMIT ".$count.""
				   		."  OFFSET ".$offset."");
				}
                break;
            case "all":
                if (!empty($a)) {
				    $result = $db->query("SELECT * FROM `".$category."`"
				        ."  WHERE `news_date` AND `news_source_link` = '".$a."'"
				        ."  LIMIT ".$count.""
				        ."  OFFSET ".$offset."");
				}
				else{
					$result = $db->query("SELECT * FROM `".$category."`"
				   		." 	ORDER BY `news_date` DESC"
				   		."  LIMIT ".$count.""
				   		."  OFFSET ".$offset."");
				}
                break;



            case "search":
                    if (!empty($a)) {
                        $result = $db->prepare(" SELECT * FROM `".$category."`"
                            ." WHERE `news_title` LIKE :search "
                            ." AND `news_source_link` = '".$a."'"
                            ." ORDER BY `news_date` DESC"
                            ." LIMIT ".$count.""
                            ." OFFSET ".$offset." ");
                    }
                    else{
                        $result = $db->prepare(" SELECT * FROM `".$category."`"
                            ." WHERE `news_title` LIKE :search"
                            ." ORDER BY `news_date` DESC" 
                            ." LIMIT ".$count.""
                            ." OFFSET ".$offset." ");
                    }
                        $result -> execute(array('search' => '%'.$search.'%'));
                    break;

            default:
                $result = $db->query("SELECT * FROM `all` ORDER BY `news_date` DESC LIMIT ".$count." OFFSET ".$offset."");
            break;
        }




		

		//$i = 0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			//$i++;
			/*$row['news_date'] = date_create($row['news_date'])->Format("H:i");
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['news_title'] = $row['news_title'];
			$newsList[$i]['news_link'] = $row['news_link'];
			$newsList[$i]['news_date'] = $row['news_date'];
			$newsList[$i]['name_source'] = $row['name_source'];
			$newsList[$i]['news_source_link'] = $row['news_source_link'];
			$newsList[$i]['news_source_img'] = '/view/mediaslon/template/'.$row['news_source_img'];
			$newsList[$i]['news_description'] = $row['news_description'];
			$newsList[$i]['seen'] = $row['seen'];*/


			switch ($time) {
				case 'minute':
					$row['news_date'] = date_create($row['news_date'])->Format("H:i:s");
					break;
				case 'hours':
					$row['news_date'] = date_create($row['news_date'])->Format("H:i");
					break;
				case 'day':
					$row['news_date'] = date_create($row['news_date'])->Format("H:i, d.m");
					break;
				case 'week':
					$row['news_date'] = date_create($row['news_date'])->Format("d.m.Y");
					break;
				case 'all':
					$row['news_date'] = date_create($row['news_date'])->Format("H:i, d.m");
					break;
				case 'search':
					$row['news_date'] = date_create($row['news_date'])->Format("H:i, d.m.Y");
					break;
				default:
					$row['news_date'] = date_create($row['news_date'])->Format("H:i, d.m.Y");
					break;
			}

			
			$row['news_source_img'] = '/view/news-market/template/'.$row['news_source_img'];
			$row['seen'] = (int)$row['seen'];
			array_push($newsList, $row);
		}
			//print_r($newsList);
			return $newsList;


	}
}

?>
