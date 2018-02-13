<?php
error_reporting(0);
require_once "Db.php";
class ActionQuery
{
    private $db;
    public function __construct()
    {
        $this->db = Db::getConnection();
    }
    private function insertQuery(){
    	$name = $_POST['name'];
    	$subject = $_POST['selected'];
    	$email = $_POST['email'];
    	$text = $_POST['text'];

        if (empty($name) && empty($subject) && empty($email) && empty($text)) {
            header("Location: https://news-market.info");
        }
        else{
            $stmt = $this->db->prepare("INSERT INTO `feedback` (
                `name`, 
                `subject`,
                `mail`,
                `text`, 
                `date`) VALUES (
                :name, 
                :subject, 
                :email, 
                :textAll,
                NOW())");

            $array = array("'", '"', "*", "%20", "%27");
            $name = str_replace( $array, "", $name);
            $subject = str_replace( $array, "", $subject);
            $email = str_replace( $array, "", $email);
            $text = str_replace( $array, "", $text);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':textAll', $text);
            $stmt->execute();    
        }		
    }
    public function addValue(){
         $this->insertQuery();
    }
}
$actionQuery = new ActionQuery();
$actionQuery->addValue();
die();
?>
