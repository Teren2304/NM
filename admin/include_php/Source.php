<?php
require_once "Db.php";

class ActionQuery
{
    private $db;
    private $all_source;
    private $paramsPath;
    private $params;
    	
    public function __construct()
    {
        $this->db = Db::getConnection();
        $this->all_source = array();
        $this->paramsPath = 'db_params.php';
    	$this->params = include($this->paramsPath);
    }

    private function selectQuery($select){
        $result = $this->db->query($select);
        while ($row = $result->fetch()) {
            array_push($this->all_source, $row);
        }
        echo json_encode($this->all_source, JSON_UNESCAPED_UNICODE);
    }

    private function insertQuery(){
    	$name = $_POST['name'];
    	$icon = $_POST['icon'];
    	$link = $_POST['link'];
    	$category = $_POST['category'];
    	$status = $_POST['status'];
		$result = $this->db->query("INSERT INTO `source`(
			`name`, 
			`icon`, 
			`link`,
			`category`, 
			`status`) VALUES (
			'".$name."', 
			'".$icon."', 
			'".$link."', 
			'".$category."', 
			'".$status."')");
    }

    private function updateQuery(){
    	$id = $_POST['id'];
    	$name = $_POST['name'];
    	$icon = $_POST['icon'];
    	$link = $_POST['link'];
    	$category = $_POST['category'];
    	$status = $_POST['status'];

    	$result = $this->db->query("UPDATE `source` SET 
    		`name` = '".$name."', 
    		`icon` = '".$icon."', 
    		`link` = '".$link."', 
    		`category` = '".$category."',  
    		`status` = '".$status."' WHERE `id` = '".$id."'");
    }

    private function deleteAllQuery(){
			$sourceName = $_POST["name"];
			$db_name = $this->params['dbname'];
			$all_tables = array();
			$result = $this->db->query("SHOW TABLES FROM $db_name");
			while ($row = $result->fetch()) {
				array_push($all_tables, $row);
			}
			foreach ($all_tables as $value) {
				$this->db->query("DELETE FROM `".$value["Tables_in_news"]."` WHERE `name_source` = '".$sourceName."'");	
			}
    }

    private function deleteQuery(){
		$id = $_POST["id"];
		$result = $this->db->query("DELETE FROM `source` WHERE `id` = '$id'");
    }
	



    public function selectValue(){
         $this->selectQuery("SELECT * FROM `source` ORDER BY `name` ASC");
    }
    public function addValue(){
         $this->insertQuery();
    }
    public function updateValue(){
         $this->updateQuery();
    }
    public function deleteAllValue(){
         $this->deleteAllQuery();
    }
    public function deleteValue(){
         $this->deleteQuery();
    }
}

$actionQuery = new ActionQuery();

$action = $_GET['action'];
switch ($action) {
    case 'read':
        $actionQuery->selectValue(); break;
    case 'add':
        $actionQuery->addValue(); break;
    case 'update':
        $actionQuery->updateValue(); break;
    case 'delete_all_news':
        $actionQuery->deleteAllValue(); break;
    case 'delete':
        $actionQuery->deleteValue(); break;
    default:
        $actionQuery->selectValue(); break;
}
die();
?>