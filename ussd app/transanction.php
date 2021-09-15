<?php

require_once('conn.php');

//first case progress menus
function transaction($dbh,$phone,$pin,$amount,$receiver,$lan, $details){  
      

       

            // build sql statement
            $stmt = $dbh->query("SELECT * FROM 	sql11437423.user where phoneNumber = $phone;");
            //execute insert query   
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

               extract($row);

               $pn = $row['pin'];
               $acc = $row['accountNumber'];
               $balance = $row['balance']; 
            }

            if ($details[4] == $pn) {
               
               trans($dbh,$phone,$pin,$amount,$receiver,$lan, $details, $acc, $balance);
         //  ussd_proceed($ussd_text);  

            }else{
               pincheck($lan);
            }
         
        
}


function trans($dbh,$phone,$pin,$amount,$receiver,$lan, $details, $acc, $balance){  

// build sql statement
$stmt1 = $dbh->query("SELECT * FROM 	sql11437423.user where phoneNumber = $receiver;");
//execute insert query   
$stmt1->execute();

while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {

   extract($row);

 
   $acc1 = $row['accountNumber']; 
}

$net = $balance - $amount;

if ($net > 0) {
   $stmt2 = $dbh->query("UPDATE `sql11437423`.`user` SET `balance` = balance - $amount WHERE (`accountNumber` = $acc);");
$stmt3 = $dbh->query("UPDATE `sql11437423`.`user` SET `balance` = balance + $amount WHERE (`accountNumber` = $acc1);");
//execute insert query   
// $stmt2->execute();
$stmt = $dbh->query("SELECT * FROM sql11437423.user where phoneNumber = $phone;");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

   extract($row);

 
   $balance = $row['balance']; 
}
// $phon = (int)substr($phone, 1);
$sendDetail = "send MK". $amount ." to ". $receiver;
$receiverDetail = "received MK". $amount ." from". $phone;

senderlog($phone, $sendDetail, $dbh);
senderlog($receiver, $receiverDetail, $dbh);
sent($details, $balance, $lan, $acc, $receiver, $dbh);

}else{
   switch ($lan) {
      case 1:
         echo "CON Insufficient funds";
         break;
      
      default:
      echo "CON Mwadutsa mulingo wandalama zomwe mulinazo \n 98. Kubwelera pambuyo \n 99. Menyu yoyambilira ";
         break;
   }

}



}
?>