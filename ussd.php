<?php

$sessionId = $_POST["sessionId"]; 
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

if ($text == "") {
    $response1 = "CON 1. Balance Enquiry \n";
    $response2 = "2. Send Money \n";
    $response3 = "3. Make Payment \n";
    $response4 = "4. Buy Airtime \n";
    $response5 = "5. Other Service";

}elseif ($text == "2") {
    $response = "CON 1. To Account\n";
    $response = "2. To Saved Accounts";
    $response = "3. To Phone Number";
    $response = "END 4. To Other Banks";
    
}

header('content-type: text/plain');
echo $response1;
echo $response2;
echo $response3;
echo $response4;
echo $response5;

?>