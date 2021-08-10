<?php

$sessionId = $_POST["sessionId"]; 
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];
$ussd_string_exploded = explode("*", $text);
$level = count($ussd_string_exploded);


    while(array_search("98", $ussd_string_exploded, true) !=false){
        $index = array_search("98", $ussd_string_exploded, true);
        array_splice($ussd_string_exploded, $index-1,2);
        }
    $text = join("*", $ussd_string_exploded);


    while(array_search("99",$ussd_string_exploded, true) !=false){
        $index = array_search("99",$ussd_string_exploded, true);
        array_splice($ussd_string_exploded,0,$index+1);
        $level = 0;
    }
    $text = join("*",$ussd_string_exploded);



if ($text == "") {
    $response0 = "CON Online banking: \n";
    $response1 = "1. Balance Enquiry \n";
    $response2 = "2. Send Money \n";
    $response3 = "3. Make Payment \n";
    $response4 = "4. Buy Airtime \n";
    $response5 = "5. Other Service";

}elseif ($text == "2") {
    $response0 = "CON Select: \n";
    $response1 = "1. To Account \n";
    $response2 = "2. To Saved Accounts \n";
    $response3 = "3. To Phone Number \n";
    $response4 = "4. To Other Banks";
    
}elseif ($text == "3") {
    $response0 = "CON Notification: \n";
    $response1 = "END utility providers \n";
}elseif ($text == "4") {
    $response0 = "CON Please Select: \n";
    $response1 = "1. Top up self \n";
    $response2 = "2. To other number";

}elseif ($text == "5") {
    $response0 = "CON Notification: \n";
    $response1 = "END other service";
}elseif ($text == "2*1") {
    $response0 = "CON Notification: \n";
    $response1 = "Enter account number";
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 1 && $level == 3) {
    $response0 = "CON Notification: \n";
    $response1 = "Enter amount to send to " .$ussd_string_exploded[2];
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 1 && $level == 4) {
    $response0 = "CON Notification: \n";
    $response1 = "CON You are trying to send k" .$ussd_string_exploded[3]. " amount to " .$ussd_string_exploded[2]. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 1 && $level == 5) {
    $response0 = "CON Notification: \n";
    $response1 = "END Successfully transferred ";
    
}elseif ($text == "2*3") {
    $response0 = "CON Notification: \n";
    $response1 = "Enter phone number";
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 3 && $level == 3) {
    $response0 = "CON Notification: \n";
    $response1 = "Enter amount to send to " .$ussd_string_exploded[2];
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 3 && $level == 4) {
    $response0 = "CON Notification: \n";
    $response1 = "You are trying to send k" .$ussd_string_exploded[3]. " amount to " .$ussd_string_exploded[2]. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 3 && $level == 5) {
    $response0 = "CON Notification: \n";
    $response1 = "END Successfully transferred ";
    
}

elseif ($text == "4*1") {
    $response0 = "CON Notification: \n";
    $response1 = "Enter amount";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 1 && $level == 3) {
    $response0 = "CON Notification: \n";
    $response1 = "You are trying to purchase airtime of k" .$ussd_string_exploded[2]. " to " .$phoneNumber. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 1 && $level == 4) {
    $response0 = "CON Notification: \n";
    $response1 = "END You have successfully purchased airtime ";
    
}elseif ($text == "4*2") {
    $response0 = "CON Notification: \n";
    $response1 = "Enter phone number";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 2 && $level == 3) {
    $response0 = "CON Notification: \n";
    $response1 = "Enter amount to send to " .$ussd_string_exploded[2];
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 2 && $level == 4) {
    $response0 = "CON Notification: \n";
    $response1 = "You are trying to purchase k" .$ussd_string_exploded[3]. " airtime for " .$ussd_string_exploded[2]. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 2 && $level == 5) {
    $response0 = "CON Notification: \n";
    $response1 = "END You have successfully purchased airtime ";
    
}

header('content-type: text/plain');
echo $response0;
echo $response1;
echo $response2;
echo $response3;
echo $response4;
echo $response5;

?>