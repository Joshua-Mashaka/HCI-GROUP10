<?php

require_once('conn.php');

//first case progress menus
function Cash_Out($details,$phone,$dbh, $lan){  
      
    if (count($details)==1)
     {  
      switch ($lan) {  
        // If user selected 1 send them to cash out menu
         case 1:      
          $ussd_text="Enter agent code";
         break; 

         case 2:
          $ussd_text="Lembani nambala ya agent : ";
         break;  
          
        }
       ussd_proceed($ussd_text);
      //  back($details);  
     }  
     
     if(count($details)== 2)
     {
         
      amount($details,$lan);
      // back($details);
       }
       
       if (count($details)==3)
        {  
          $amount = $details[2];
          confirm($details, $amount, $lan);
  
        }

       if (count($details)==4)
        {  


            // build sql statement
            $stmt = $dbh->query("SELECT * FROM sql4435724.user where phoneNumber = $phone && pin = $details[3];");
            //execute insert query   
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

               extract($row);

             
               $acc = $row['accountNumber']; 
            }
            
            $stmt2 = $dbh->query("UPDATE `sql4435724`.`user` SET `balance` = balance - $details[2] WHERE (`accountNumber` = $acc);");
            //execute insert query   
            // $stmt2->execute();
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

               extract($row);

             
               $balance = $row['balance']; 
            }


            sent($details, $balance, $lan);
        }
}


?>