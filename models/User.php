<?php

class User{

    private $conn;
    private $table = 'user';


    
    public $username;
    public $email;
    public $password;


    public function __construct($db){
        $this->conn = $db;
    }

    public function getUser(){
        $query = 'SELECT id, username, email FROM '.$this->table.' ORDER BY 1 DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getOne($id){
        $query = 'SELECT username, email FROM '.$this->table.' WHERE id = '.$id.' ORDER BY 1 DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function createUser(){
        $query = "INSERT INTO user
                    SET
                    username=:username, 
                    email=:email, 
                    password=:password";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }

        //return $stmt;

    }

    public function changePassword($id){
        $query = "UPDATE user
                    SET
                    password=:password
                    WHERE id = $id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':password', $this->password);
       
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }


    }
    public function deleteUser($id){
        $query = "DELETE FROM user
        WHERE id = $id";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()){
            return true;
            }else{
            return false;
            }
    }
}