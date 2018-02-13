<?php
error_reporting(0);
require_once "Db.php";
ini_set( 'date.timezone', 'Europe/Kiev' ); 

class ActionQuery
{
    private $db;
    private $all_news;
    private $res;
    private $count;
    private $offset;
    private $sort;
    private $category;
    private $dateTo;
    private $source;

    public function __construct()
    {
        $this->db = Db::getConnection();
        $this->all_news = array();
        $this->res = array();
        $this->all_tables = array();
        $this->source = array();
        $this->dateTo = date("Y-m-d H:i:s");
        $this->count = 50;
        $this->sort = "all";
        $this->sort = $_GET['sortBy'];
    }


    private function selectQuery($select, $format){
        $result = $this->db->query($select);
       
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $row['news_date'] = date_create($row['news_date'])->Format($format);
            array_push($this->all_news, $row);
           
        }
        $this->res = $this->all_news;
        echo json_encode($this->res, JSON_UNESCAPED_UNICODE);
    }

    private function selectSource(){
        $result = $this->db->query("SELECT en_name FROM category");
        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $i++;
            $this->source[$i] = $row['en_name'];
        }
    }

    public function selectValue(){
        $format = 'H:i:s, d.m.Y';
        $a = $_POST['name_source'];

        $this->selectSource();

        if(in_array($_GET['category'], $this->source)) {
            $this->category = $_GET['category'];
        }
        else{
            header("Location: http://news-market.info");
            $this->category = 'all';
        }

        $number = intval($_GET['offset']);
        if ($number && preg_match('/^[0-9]\d*$/', $number) || $_GET['offset'] == 0)
        {
            $this->offset = $_GET['offset'];  
        }
        else{
            header("Location: http://news-market.info");
            $this->offset = 0;
        }

        $this->offset = $this->offset * $this->count;

        switch ($this->sort) {
            case "10":
                $dateFrom = date('Y-m-d H:i:s', date("U")-600);
                $format = 'H:i:s';
                if (!empty($a)) {
                    $this->selectQuery("SELECT * FROM `".$this->category."`"
                        ."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$this->dateTo."' AND `name_source` = '".$a."'"
                        ."  ORDER BY `news_date` DESC"
                        ."  LIMIT ".$this->count.""
                        ."  OFFSET ".$this->offset."", $format);
                }
                else{
                    $this->selectQuery("SELECT * FROM `".$this->category."`"
                        ."  WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$this->dateTo."'"
                        ."  ORDER BY `news_date` DESC"
                        ."  LIMIT ".$this->count.""
                        ."  OFFSET ".$this->offset."", $format);
                }
                break;

            case "60":
                $dateFrom = date('Y-m-d H:i:s', date("U")-3600);
                $format = 'H:i:s';
                if (!empty($a)) {
                    $this->selectQuery("SELECT * FROM `".$this->category."`"
                        ." WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$this->dateTo."' AND `name_source` = '".$a."'"
                        ." ORDER BY `news_date` DESC"
                        ." LIMIT ".$this->count.""
                        ." OFFSET ".$this->offset."", $format);
                }
                else{
                    $this->selectQuery("SELECT * FROM `".$this->category."`"
                        ." WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$this->dateTo."'"
                        ." ORDER BY `news_date` DESC"
                        ." LIMIT ".$this->count.""
                        ." OFFSET ".$this->offset."", $format);
                }
                break;

            case "day":
                $dateFrom = date('Y-m-d H:i:s', date("U")-86400);
                if (!empty($a)) {
                    $this->selectQuery("SELECT * FROM `".$this->category."`"
                        ." WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$this->dateTo."' AND `name_source` = '".$a."'"
                        ." ORDER BY `news_date` DESC"
                        ." LIMIT ".$this->count.""
                        ." OFFSET ".$this->offset."", $format);
                }
                else{
                    $this->selectQuery("SELECT * FROM `".$this->category."`"
                        ." WHERE `news_date` BETWEEN '".$dateFrom."' AND '".$this->dateTo."'"
                        ." ORDER BY `news_date` DESC"
                        ." LIMIT ".$this->count.""
                        ." OFFSET ".$this->offset."", $format);
                }
                break;

            case "all":
                if (!empty($a)) {
                   $this->selectQuery("SELECT * FROM `".$this->category."`" 
                    ." WHERE `name_source` = '".$a."'"
                    ." ORDER BY `news_date` DESC"
                    ." LIMIT ".$this->count.""
                    ." OFFSET ".$this->offset."", $format);
                }
                else{
                    $this->selectQuery("SELECT * FROM `".$this->category."`" 
                    ." ORDER BY `news_date` DESC"
                    ." LIMIT ".$this->count.""
                    ." OFFSET ".$this->offset."", $format);
                }
                break;

            case "search":
                $search = $_GET['search'];
                    if (!empty($a)) {
                        $result = $this->db->prepare(" SELECT * FROM `".$this->category."`"
                            ." WHERE `news_title` LIKE :search "
                            ." AND `name_source` = '".$a."'"
                            ." ORDER BY `news_date` DESC"
                            ." LIMIT ".$this->count.""
                            ." OFFSET ".$this->offset." ");
                    }
                    else{
                        $result = $this->db->prepare(" SELECT * FROM `".$this->category."`"
                            ." WHERE `news_title` LIKE :search"
                            ." ORDER BY `news_date` DESC" 
                            ." LIMIT ".$this->count.""
                            ." OFFSET ".$this->offset." ");
                    }
                        $result -> execute(array('search' => '%'.$search.'%'));
                        $i = 0;
                        while($row = $result->fetch(PDO::FETCH_ASSOC)){
                          //  array_push($this->all_news, $row);
                            $this->all_news[$i]['id'] = $row['id'];
                            $this->all_news[$i]['news_title'] = $row['news_title'];
                            $this->all_news[$i]['news_link'] = $row['news_link'];
                            $this->all_news[$i]['news_date'] = $row['news_date'];
                            $this->all_news[$i]['name_source'] = $row['name_source'];
                            $this->all_news[$i]['news_source_link'] = $row['news_source_link'];
                            $this->all_news[$i]['news_source_img'] = $row['news_source_img'];
                            $this->all_news[$i]['news_description'] = $row['news_description'];
                            $this->all_news[$i]['news_img'] = $row['news_img'];
                            $i++;
                        }
                        $this->res = $this->all_news;
                        echo json_encode($this->res, JSON_UNESCAPED_UNICODE);
                    break;
            default:
                $this->selectQuery("SELECT * FROM `economy` ORDER BY `news_date` DESC LIMIT ".$this->count."", $format);
                //header("Location: http://news-market.info");
            break;
        }
    }
}


$actionQuery = new ActionQuery();
$actionQuery->selectValue();

   // header("Location: http://localhost/news_market/404.php");





?>