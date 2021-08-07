<?php

$sessionId = $_POST["sessionId"]; 
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

if ($text == "") {
    $response = "1. Balance Enquiry\n"; 
    $response = "2. Send Money\n";
    $response = "3. Make Payment\n";
    $response = "4. Buy Airtime\n";
    $response = "5. Other Service";
}elseif ($text == "2") {
    $response = "1. To Account\n";
    $response = "2. To Saved Accounts";
    $response = "3. To Phone Number";
    $response = "4. To Other Banks";
    
}

header('content-type; text/plain');
echo $response;

?>