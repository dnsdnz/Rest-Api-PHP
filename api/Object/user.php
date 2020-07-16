<?php
class User{
 
    private $conn;      //database connection and table name
    private $table_name = "users";
 
    public $id;     //object properties
    public $username;
    public $password;
    public $created;
 
    public function __construct($db){   //constructor with $db as database connection
        $this->conn = $db;
    }
    
    function signup(){      //signup user
    
        if($this->isAlreadyExist()){
            return false;
        }

        //query to insert record
        $query = "INSERT INTO        //
                    " . $this->table_name . "
                SET
                    username=:username, password=:password, created=:created";
    
      
        $stmt = $this->conn->prepare($query);     //prepare query
    
        $this->username=htmlspecialchars(strip_tags($this->username));   //sanitize
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        $stmt->bindParam(":username", $this->username);      //bind values
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);
    
        if($stmt->execute()){       //execute query
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
    }
 
    function login(){        //login user
        //select all query
        $query = "SELECT
                    `id`, `username`, `password`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE
                    username='".$this->username."' AND password='".$this->password."'";
        
        $stmt = $this->conn->prepare($query);       //prepare query statement
        $stmt->execute();        //execute query
        return $stmt;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."'";
       
        $stmt = $this->conn->prepare($query);      //prepare query statement
        
        $stmt->execute();       //execute query
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}