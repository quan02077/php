<?php
header('Content-Type: application/json');

$api = 'https://api.currencyfreaks.com/v2.0/rates/latest?apikey=a4088e474ef64fb4a54893656ed81322';

$response = file_get_contents($api);
if($response){
    echo $response;
}
else{
    echo json_encode([]);
}

exit;
?>