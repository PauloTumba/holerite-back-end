<?php


// function conectarBD(){

// 	$host="host=localhost";
// 	$port="port=5432";
// 	$dbname="dbname=postgres";
// 	$user="user=paulo";
// 	$password="password=alcatel";

// 	$conn= pg_connect("$host $port $dbname $user $password");
// 	if(!$conn){
// 		echo "Error:".pg_last_error;
// 	}else{
// 		echo "<h3></hr>Conectou com sucesso<hr>";
// 		return $conn;
// 	}
	
// }

class Database{
	
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "postgres";
    private $username = "postgres";
    private $password = "alcatel";
	public $conn;

 
    // get the database connection
    public function getConnection(){
		
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
		}
		if(!$this->conn){
			
				echo "Erro ao conectar";
		}else{
			
			// echo"Sucesso";
			return $this->conn;
			
		}
 
       
    }
}



