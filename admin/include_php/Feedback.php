<?php
require_once "Db.php";

class ActionQuery
{
    private $db;
    private $all_feedback;

    public function __construct()
    {
        $this->db = Db::getConnection();
        $this->all_feedback = array();
    }

    private function selectQuery($select){
        $result = $this->db->query($select);
        while ($row = $result->fetch()) {
            array_push($this->all_feedback, $row);
        }
        echo json_encode($this->all_feedback, JSON_UNESCAPED_UNICODE);
    }

    private function deleteQuery(){
        $id = $_POST["id"];
        $result = $this->db->query("DELETE FROM `feedback` WHERE `id` = '$id'");
    }

    private function updateQuery(){
        $id = $_POST["id"];
        $result = $this->db->query("UPDATE `feedback` SET `action` = '0' WHERE `id` = '".$id."'");
    }

    public function selectValue(){
         $this->selectQuery("SELECT * FROM `feedback` ORDER BY `action` DESC");
    }
    public function deleteValue(){
         $this->deleteQuery();
    }
    public function updateValue(){
         $this->updateQuery();
    }
}

$actionQuery = new ActionQuery();
$action = $_GET['action'];

switch ($action) {
    case 'read':
        $actionQuery->selectValue(); break;
    case 'delete':
        $actionQuery->deleteValue(); break;
    case 'update':
        $actionQuery->updateValue(); break;
    default:
        $actionQuery->selectValue(); break;
}




?>