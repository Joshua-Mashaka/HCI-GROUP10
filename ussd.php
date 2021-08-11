<?php

// $conn = 'msql:dbname=ussdapp; host=127.0.0.1;';
// $user = 'root';
// $password = '';

// try{
//     $db = new PDO($conn, $user, $password);
//     echo("connected successfully");
// }

// catch(PDOException $e) {
//     echo("PDO error occured");
// }

// catch(Exception $e) {
//     echo("PDO error occured");
// }

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$sessionId = $_POST["sessionId"]; 
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

// $sql = "SELECT id, firstname, lastname FROM MyGuests";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
//   }
// } else {
//   echo "0 results";
// }

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

if ($text = "") {
    $response = "enter user name";

}
    $sql = "INSERT INTO MyGuests (userName)
VALUES ($text)";

header('content-type: text/plain');
echo $response1;
echo $response2;
echo $response3;
echo $response4;
echo $response5;

?>