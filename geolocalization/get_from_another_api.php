<?php


include_once '../config/database.php';
include_once '../objects/geolocalization.php';
 
$get_data = callAPI('GET', 'https://api.example.com/get_url/'.$user['User']['customer_id'], false);
$response = json_decode($get_data, true);
$errors = $response['response']['errors'];
$data = $response['response']['data'][0];