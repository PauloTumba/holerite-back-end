<?php
class Geolocalization{
 
    // database connection and table name
    private $conn;
    private $table_name = "geolocalizations";
 
    // propriedade dos objectos
    public $id;
    public $vc_nome;
    public $vc_email;
    public $vc_senha;
    public $token;
  
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read geolocalization
    function read(){
 
    // select all query
    $query = "SELECT id, vc_nome, vc_email, vc_senha, token FROM  cofco.login";
                
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

// create geolocalization
function create(){
 
// query to insert
    $query ="INSERT into cofco.login(
                vc_nome,
                vc_email,
                vc_senha,
                token
                )values(:vc_nome, :vc_email,:vc_senha,:token)";

            // INSERT INTO
            // ". $this->table_name ."
            //  SET
            // city=:city, region=:region, country=:country, country_code=:country_code, ip=:ip";

    // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->vc_nome=htmlspecialchars(strip_tags($this->vc_nome));
        $this->vc_email=htmlspecialchars(strip_tags($this->vc_email));
        $this->vc_senha=htmlspecialchars(strip_tags($this->vc_senha));
        $this->token=htmlspecialchars(strip_tags($this->token));
    
        $outra=md5(uniqid(mt_rand(), true));
        // bind values
        $stmt->bindParam(":vc_nome", $this->vc_nome);
        $stmt->bindParam(":vc_email", $this->vc_email);
        $stmt->bindParam(":vc_senha", $this->vc_senha);
        $stmt->bindParam(":token", $outra);
       
    
        // executar query query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

// used when filling up the update geolocalization form
function readOne(){

        // $car=function update();
        // var_dump($car);

        // $temp = Geolocalization::update($stmt);
        // $result = json_decode($temp,true);
        // var_dump($tem);    
       
    // query to read single record
    $query = "SELECT id, vc_nome, vc_email, vc_senha, token FROM cofco.login where vc_email=? and vc_senha=?
              ";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of geolocalization to be updated
    $stmt->bindParam(1, $this->vc_email);
    $stmt->bindParam(2, $this->vc_senha); 
    // execute query
    $stmt->execute(); 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    // set values to object properties    
    $this->id = $row['id'];
    $this->vc_nome = $row['vc_nome'];
    $this->vc_email = $row['vc_email'];
    $this->vc_senha = $row['vc_senha'];
    $this->token =$row['token'];

   

    $query = 'UPDATE cofco.login SET
    vc_nome = :vc_nome,
    vc_email = :vc_email,
    vc_senha = :vc_senha,
    token = :token
    where id = :id';

// prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->vc_nome=htmlspecialchars(strip_tags($this->vc_nome));
    $this->vc_email=htmlspecialchars(strip_tags($this->vc_email));
    $this->vc_senha=htmlspecialchars(strip_tags($this->vc_senha));
    $this->token=htmlspecialchars(strip_tags($this->token));

    $outra=md5(uniqid(mt_rand(), true));
    // bind new values
    $stmt->bindParam(':vc_nome', $this->vc_nome);
    $stmt->bindParam(':vc_email', $this->vc_email);
    $stmt->bindParam(':vc_senha', $this->vc_senha);
    $stmt->bindParam(':token', $outra);
    $stmt->bindParam(':id', $this->id);


    // execute the query
    if($stmt->execute()){
    return $stmt;
    }

      $query = "SELECT id, vc_nome, vc_email, vc_senha, token FROM cofco.login where vc_email=? and vc_senha=?
              ";

  
}

// update the geolocalization

function update($stmt){
 
    // update query
    $query = "UPDATE cofco.login SET
                vc_nome = :vc_nome,
                vc_email = :vc_email,
                vc_senha = :vc_senha,
                token = :token
                where id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->vc_nome=htmlspecialchars(strip_tags($this->vc_nome));
    $this->vc_email=htmlspecialchars(strip_tags($this->vc_email));
    $this->vc_senha=htmlspecialchars(strip_tags($this->vc_senha));
    $this->token=htmlspecialchars(strip_tags($this->token));
  
   
    // bind new values
    $stmt->bindParam(':vc_nome', $this->vc_nome);
    $stmt->bindParam(':vc_email', $this->vc_email);
    $stmt->bindParam(':vc_senha', $this->vc_senha);
    $stmt->bindParam(':token', $token=md5(uniqid(mt_rand(), true)));
    $stmt->bindParam(':id', $this->id);
   
 
    // execute the query
    if($stmt->execute()){
        return $stmt;
    }
 
    return false;
}


// delete geolocalization
function delete(){
 
    // delete query
    $query = "DELETE FROM dados.products WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

// search geolocalization
function search($keywords){
    $keywords = trim($keywords);
    $keywords = strtolower($keywords);
 
    // select all query
    $query = "SELECT
    city, region, country, country_code, ip
    FROM
    dados.products where
            lower(city) LIKE ? OR region LIKE ? OR ip LIKE ?
            ORDER BY
                city  ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}


                    

}