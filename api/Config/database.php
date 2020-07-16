<?php
class Database{
 
    private $host = "localhost";    // specify your own database credentials
    private $db_name = "RestApi";
    private $username = "root";
    private $password = "";
    public $conn;
 
    public function getConnection(){      // get the database connection
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>