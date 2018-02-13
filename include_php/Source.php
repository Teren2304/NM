<?php
//error_reporting(0);
require_once "Db.php";
ini_set( 'date.timezone', 'Europe/Kiev' ); 

class ActionQuery
{
    private $db;
    private $all_source;

    public function __construct()
    {
        $this->db = Db::getConnection();
        $this->all_source = array();
    }


    private function selectSource(){
        $result = $this->db->query("SELECT name, icon FROM source GROUP BY `name`");
        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $i++;
            $this->all_source[$i]['id'] = $i;
            $this->all_source[$i]['name'] = $row['name'];
            $this->all_source[$i]['icon'] = 'img/source/'.$row['icon'];
        }
        echo json_encode($this->all_source, JSON_UNESCAPED_UNICODE);
    }

    public function selectValue(){
        $this->selectSource();
    }
}
$actionQuery = new ActionQuery();
$actionQuery->selectValue();
?>