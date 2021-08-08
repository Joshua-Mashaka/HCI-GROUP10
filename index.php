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
    $response1 = "CON 1. To Account \n";
    $response2 = "2. To Saved Accounts \n";
    $response3 = "3. To Phone Number \n";
    $response4 = "4. To Other Banks";
    
}elseif ($text == "3") {
    $response1 = "END utility providers \n";
}elseif ($text == "4") {
    $response1 = "CON 1. Top up self \n";
    $response2 = "2. To other number";

}elseif ($text == "5") {
    $response1 = "END other service";
}elseif ($text == "2*1") {
    $response1 = "CON Enter account number";
    
}elseif ($text == "2*1* ") {
    $response1 = "CON Enter amount";
    
}

header('content-type: text/plain');
echo $response1;
echo $response2;
echo $response3;
echo $response4;
echo $response5;

?>