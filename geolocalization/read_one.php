<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET, POST, PUT ");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/geolocalization.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare geolocalization object
$geolocalization = new Geolocalization($db);
 
// set ID property of record to read
$geolocalization->vc_email = isset($_GET['vc_email'])? $_GET['vc_email'] : die();
$geolocalization->vc_senha = isset($_GET['vc_senha'])? $_GET['vc_senha'] : die();
 
// read the details of geolocalization to be edited
$geolocalization->readOne();
 
if($geolocalization->id!=null){
    // create array
    $geolocalizations_arr = array(
        "id" =>  $geolocalization->id,
        "vc_nome" => $geolocalization->vc_nome,
        "vc_email" => $geolocalization->vc_email,
        "vc_senha" => $geolocalization->vc_senha,
        "token" => $geolocalization->token
     
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($geolocalizations_arr);
}
 


?>