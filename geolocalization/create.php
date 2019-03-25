<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php'; 
// instantiate geolocalization object
include_once '../objects/geolocalization.php'; 
$database = new Database();
$db = $database->getConnection(); 
$geolocalization = new Geolocalization($db); 
// get posted data
$data = json_decode(file_get_contents("php://input"));
// set geolocalization property values
$geolocalization->vc_nome = $data->vc_nome;
$geolocalization->vc_email = $data->vc_email;
$geolocalization->vc_senha = $data->vc_senha;
// $geolocalization->token = $data->token; 
// create geolocalization
if($geolocalization->create()){

    // set response code - 201 created
    http_response_code(200);


}


     
?>