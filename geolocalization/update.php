<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/geolocalization.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare geolocalization object
$geolocalization = new Geolocalization($db);
 
// get id of geolocalization to be edited
$data = json_decode(file_get_contents("php://input"));
 var_dump($data) ;
// set ID property of geolocalization to be edited
$geolocalization->id = $data->id;
 
// set geolocalization property values
$geolocalization->vc_nome = $data->vc_nome;
$geolocalization->vc_email = $data->vc_email;
$geolocalization->vc_senha = $data->vc_senha;
$geolocalization->token = $data->token;

 
// update the geolocalization
if($geolocalization->readOne()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "geolocalization was updated."));
}
 
// if unable to update the geolocalization, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update geolocalization."));
}
?>