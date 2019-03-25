<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin:http://localhost:4200");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once __DIR__ . '/../config/conexao.php';
$conexao=conectarBD();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    $datas = [ 
       //'codigo' => $_REQUEST['codigo'],
       'vc_nome' => $_REQUEST['vc_nome'],        
        'vc_email' => $_REQUEST['vc_email'],
        'vc_senha' =>$_REQUEST['vc_senha'],
        'token' =>md5(uniqid(mt_rand(), true))      
    
    ];
    insert($datas);
    
} else {
    
}
