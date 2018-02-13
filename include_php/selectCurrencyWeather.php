<?php
error_reporting(0);
require_once "Db.php";
class ActionQuery
{
    private $db;
    private $all_data;
    public function __construct()
    {
        $this->db = Db::getConnection();
        $this->all_data = array();
    }
    private function selectQuery($select){
        $result = $this->db->query($select);
        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->all_data[$i]['id'] = $row['id'];
            $this->all_data[$i]['EUR_sale'] = str_replace(".", ",", $row['EUR_sale']);
            $this->all_data[$i]['EUR_buy'] = str_replace(".", ",", $row['EUR_buy']);

            $this->all_data[$i]['USD_sale'] = str_replace(".", ",", $row['USD_sale']);
            $this->all_data[$i]['USD_buy'] = str_replace(".", ",", $row['USD_buy']);

            $this->all_data[$i]['RUR_sale'] = str_replace(".", ",", $row['RUR_sale']);
            $this->all_data[$i]['RUR_buy'] = str_replace(".", ",", $row['RUR_buy']);

            $this->all_data[$i]['Bitcoin_sale'] = str_replace(".", ",", $row['Bitcoin_sale']);
            $this->all_data[$i]['Bitcoin_buy'] = str_replace(".", ",", $row['Bitcoin_buy']);

            $this->all_data[$i]['weather'] = round($row['weather'], 0);
            $i++;
        }
       echo json_encode($this->all_data, JSON_UNESCAPED_UNICODE);
    }

    public function selectValue(){
        $this->selectQuery("SELECT * FROM `currency_weather` ORDER BY id DESC LIMIT 1");
    }
}
$actionQuery = new ActionQuery();
$actionQuery->selectValue();
?>