<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files

include_once '../config/database.php';
include_once '../objects/geolocalization.php';
//include_once '../geolocalization/create.php';

 
// instantiate database and geolocalization object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$geolocalization = new Geolocalization($db);
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
 
// query geolocalizations
$stmt = $geolocalization->search($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // geolocalizations array
    $geolocalizations_arr=array();
    //$geolocalizations_arr["dados"]=array();
    //$geolocalizations_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $geolocalization_content=array(
           // "id" => $id,
           "ip" => $ip,
            "city" =>html_entity_decode ($city),            
            "region" => $region,
            "country" => $country,
            "country_code" => $country_code
           
        );
 
       // array_push($geolocalizations_arr["dados"], $geolocalization_content);
        array_push($geolocalizations_arr, $geolocalization_content);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show geolocalizations data
    echo json_encode($geolocalizations_arr);
}
 
else{
    include_once '../geolocalization/insert.php';
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no geolocalizations found


    $requesturl="http://extreme-ip-lookup.com/json/$keywords";
    $ch=curl_init($requesturl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cexecute=curl_exec($ch);
    curl_close($ch);



$result = curl_init('http://localhost/api_ips/geolocalization/insert.php');
//$result = curl_init('http://localhost/api_ips/geolocalization/create.php');

curl_setopt($result, CURLOPT_RETURNTRANSFER, true);
$result = json_decode($cexecute,true);

$datas=array(
    
    // // "id" => $id,
    "ip" =>$result['query'],
     "city" => ''.$result['city'].'',         
     "region" =>$result['region'],
     "country" =>$result['country'],
     "country_code" =>$result['countryCode']
     
     
 );
            
// curl_setopt($result, CURLOPT_POST, true);

// curl_setopt($result, CURLOPT_POSTFIELDS, $datas);

// curl_exec($result);

// curl_close($result);

    echo json_encode(

        


        array(
            "ip" =>$result['query'],
            "city" => $result['city'].'',         
             "region" =>$result['region'],
            "country" =>$result['country'],
            "country_code" =>$result['countryCode']
            
            
            
           // "message" => "dados salvos."
            
            )
    );
   

                        // $iniciar = curl_init();
                                            
                        // curl_setopt($iniciar, CURLOPT_URL, "http://extreme-ip-lookup.com/json/$keywords");
                        
                        // curl_exec($iniciar);
                        
                        // curl_close($iniciar);


                      
                   

                    
}
?>