<?php



class Database{

    //DB Params
    private $username= 'root';
    private $db_name = 'restapi';
    private $host = 'localhost';
    private $password = '';
    private $conn;

    //Db function
    public function connect(){
        $this->conn = null;

        

        try{

            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,
             $this->username, $this->password);
             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Connection error'. $e->getMessage();

        }

        return $this->conn;
    }

}