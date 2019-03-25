<?php

    include_once '../config/database.php';
    include_once '../objects/atualizarToken.php';
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    
     function update(){
 
    // update query
    $query = "UPDATE cofco.login SET
                vc_nome = :vc_nome,
                vc_email = :vc_email,
                vc_senha = :vc_senha,
                token = :token
                where id = :id";
 
    // prepare query statement
    $stmt = $this->conns->prepare($query);
 
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
        return true;
    }
 
    return false;
}


