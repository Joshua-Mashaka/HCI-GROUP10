<?php

require_once('conn.php');
// require_once('saved.php');
// require_once('transaction.php');




function sendMoney($details,$phone,$dbh, $lan){
  if (count($details)==1)
     {
      displaySend($details, $lan);
     }
  if (count($details)>1){
    switch ($details[1]) {  
        // If user selected 1 send them to cash out menu
        case 1:  
        both($details,$phone,$dbh, $lan);  
        break; 
        // If user selected 2 for send money
        case 2: 
        saved($details,$phone,$dbh, $lan);  
        break;  
      
        // If user selected 3
        case 3:  
        both($details,$phone,$dbh, $lan);  
        break;

        // If user selected 4
        case 4:  
        // Airtel($details,$phone,$dbh);  
        break; 
 
    
    }
  }
}

function both($details,$phone,$dbh, $lan){
  if (count($details)==2)
  {  
    enterAmount($details, $lan);  
  }
  if(count($details)> 2)
  {
      $chec = substr($details[2],0,2);
      // echo "CON ". $chec;
      if ($chec == "09" && $details[1] == "1") {
        Airtel($details,$phone,$dbh, $lan);
      }elseif ($chec == "08" && $details[1] == "3") {
        Airtel($details,$phone,$dbh, $lan);
      }
             
    }
  }


    //first case progress menus
    function Airtel($details,$phone,$dbh, $lan){  
      
        // if (count($details)==2)
        //  {  
        //    $ussd_text="Enter phone number";  
        //    ussd_proceed($ussd_text);  
        //  }  
         
         if(count($details)== 3)
         {
          amount($details,$lan);
        }
           
           if (count($details)==4)
            {  

               
             $receiver=$details[2];
             $amount=$details[3];
              
             pincon($details, $lan, $amount, $receiver); 
            }
             
           if (count($details)==5)
            {
               
               $receiver=$details[2];
               $amount=$details[3];
               $pin = $details[4];
             
              // // build sql statement
              // $sth = $dbh->prepare("INSERT INTO `4Z2orW7dBn`.`user` (`name`, `pin`, `phoneNumber`) VALUES ('$fullName', $pin, $phone);");
              // //execute insert query   
              // $sth->execute();
              transaction($dbh,$phone,$pin,$amount,$receiver, $lan);
              // $ussd_text="successful transferred";  
              // ussd_stop($ussd_text); 
              // switch ($lan) {  
              //   // If user selected 1 send them to cash out menu
              //    case 1:      
              //       $ussd_text="Do you want to mark this as your favorite?";
              //    break; 
    
              //    case 2:
              //       $ussd_text="Mufuna kuitsunga nambala yi?";  
              //    break;  
                  
              //   }
              //   echo $ussd_text;
            }
           if (count($details)==6)
            {
              $receiver=$details[2];
               $amount=$details[3];
               $pin = $details[4];
               switch ($details[5]) {
                 case '1':
                  save($phone, $pin, $dbh, $receiver);
                  break;
                 
                 default:
                   echo "CON Thank you";
                  break;
               }
            }
   }
 
?>