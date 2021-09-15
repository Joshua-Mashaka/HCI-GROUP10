<?php

function senderlog($phone, $sendDetail, $dbh){

    // build sql statement
    // $stmt = $dbh->query("SELECT * FROM sql4435724.user where phoneNumber = $phone && pin = $pin;");
    // //execute insert query   
    // $stmt->execute();

    // while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    //    extract($row);

     
    //    $acc = $row['accountNumber']; 
    // }
    $date = " ". date("Y-m-d");
    // build sql statement
    $sth = $dbh->prepare("INSERT INTO `sql4435724`.`logs` (`phonenumber`, `details`, `date`) VALUES ($phone, '$sendDetail', '$date');");
    // //execute insert query   
    $sth->execute();

    $ussd_text="successful saved";  
    // ussd_stop($ussd_text);
}

?>