
<?php
function conectarBD(){

$host="host=localhost";
$port="port=5432";
$dbname="dbname=postgres";
$user="user=postgres";
$password="password=alcatel";

$bd= pg_connect("$host $port $dbname $user $password");
if(!$bd){
    echo "Error:".pg_last_error;
}else{
   // echo "<h3></hr>Conectou com sucesso<hr>";
    return $bd;
}

}




function insert($datas){
    // global $conexao; 
    // $city = $datas['city'];
    // $region = $datas['region'];   
    // $country = $datas['country']; 
    // $country_code = $datas['country_code'];
    // $ip = $datas['ip'];
    global $conexao; 
    $vc_nome = $datas['vc_nome'];
    $vc_email = $datas['vc_email'];   
    $vc_senha = $datas['vc_senha']; 
    $token = $datas['token'];
   
    
    

    
    $query = "INSERT into cofco.login(
        vc_nome,        
        vc_email,
        vc_senha,
        token)
        values('$vc_nome','$vc_nome', '$vc_senha','$token')";
      
    //var_dump($sql);
    pg_query($conexao, $query);
    
    //$conexao->query($sql);


} 



function login($datas){
    // global $conexao; 
    // $city = $datas['city'];
    // $region = $datas['region'];   
    // $country = $datas['country']; 
    // $country_code = $datas['country_code'];
    // $ip = $datas['ip'];
    global $conexao; 
    $vc_nome = $datas['vc_nome'];
    $vc_email = $datas['vc_email'];   
    $vc_senha = $datas['vc_senha']; 
    $token = $datas['token'];

    if(isset($vc_nome ))
   
    
    

    
    $query = "INSERT into cofco.login(
        vc_nome,        
        vc_email,
        vc_senha,
        token)
        values('$vc_nome','$vc_nome', '$vc_senha','$token')";
      
    //var_dump($sql);
    pg_query($conexao, $query);
    
    //$conexao->query($sql);


} 