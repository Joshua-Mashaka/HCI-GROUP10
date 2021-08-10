<?php

$sessionId = $_POST["sessionId"]; 
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];
$ussd_string_exploded = explode("*", $text);
$level = count($ussd_string_exploded);

function goBack($text){
   // $ussd_string_exploded = explode("*",$text);
    //The while loop is used to ensure that all occurences of "98"
    //are captured        
    while(array_search("98",$ussd_string_exploded, true) !=false){
        $index = array_search("98",$ussd_string_exploded, true);
        array_splice($ussd_string_exploded, $index-1,2);
        }
        return join("*",$ussd_string_exploded);
}
function goToMainMenu($text){
    // $ussd_string_exploded = explode("*",$text);
    while(array_search("99",$ussd_string_exploded, true) !=false){
    $index = array_search("99",$ussd_string_exploded, true);
    array_splice($ussd_string_exploded,0,$index+1);
    }
    return join("*",$ussd_string_exploded);
}


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
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 1 && $level == 3) {
    $response1 = "CON Enter amount to send to " .$ussd_string_exploded[2];
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 1 && $level == 4) {
    $response1 = "CON You are trying to send k" .$ussd_string_exploded[3]. " amount to " .$ussd_string_exploded[2]. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 1 && $level == 5) {
    $response1 = "END Successfully transferred ";
    
}elseif ($text == "2*3") {
    $response1 = "CON Enter phone number";
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 3 && $level == 3) {
    $response1 = "CON Enter amount to send to " .$ussd_string_exploded[2];
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 3 && $level == 4) {
    $response1 = "CON You are trying to send k" .$ussd_string_exploded[3]. " amount to " .$ussd_string_exploded[2]. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 2 && $ussd_string_exploded[1] == 3 && $level == 5) {
    $response1 = "END Successfully transferred ";
    
}

elseif ($text == "4*1") {
    $response1 = "CON Enter amount";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 1 && $level == 3) {
    $response1 = "CON You are trying to purchase airtime of k" .$ussd_string_exploded[2]. " to " .$phoneNumber. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 1 && $level == 4) {
    $response1 = "END You have successfully purchased airtime ";
    
}elseif ($text == "4*2") {
    $response1 = "CON Enter phone number";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 2 && $level == 3) {
    $response1 = "CON Enter amount to send to " .$ussd_string_exploded[2];
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 2 && $level == 4) {
    $response1 = "CON You are trying to purchase k" .$ussd_string_exploded[3]. " airtime for " .$ussd_string_exploded[2]. ", enter pin to confirm";
    
}elseif ($ussd_string_exploded[0] == 4 && $ussd_string_exploded[1] == 2 && $level == 5) {
    $response1 = "END You have successfully purchased airtime ";
    
}

header('content-type: text/plain');
goBack($text);
goToMainMenu($text);
echo $response1;
echo $response2;
echo $response3;
echo $response4;
echo $response5;

?>