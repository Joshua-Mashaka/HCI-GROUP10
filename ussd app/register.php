<?php

require_once('conn.php');

    //first case progress menus
    function register($details,$phone,$dbh){  
      
      if(count($details)== 1)
      {
          
          $ussd_text = "Select language \n 1. English \n 2. Chichewa";
          ussd_proceed($ussd_text);
        }
         if (count($details)==2)
          {  

            switch ($details[1]) {  
              // If user selected 1
               case 1:  
                $ussd_text="  Enter your username";    
               break; 

               case 2:
                $ussd_text="Lembani dzina lanu : ";     
               break; 
               default:
               $ussd_text = "Invalid input\n 98. back \n99. main menu"; 
                break;
              }
            ussd_proceed($ussd_text);  
          }  
          
          if(count($details)== 3)
          {
            switch ($details[1]) {  
              // If user selected 1 
               case 1:      
                $ussd_text = " Enter pin \n 98. back \n 99. main menu";
               break; 

               case 2:
                $ussd_text = " Lembani nambala ya chinsisi yomwe muzigwiritsa ntchito : \n 98. kubwerera mbuyo \n 99. menyu yoyambirira";
               break;  
                
              }   
              ussd_proceed($ussd_text);
            }
            
            if (count($details)==4)
             {  

                // if (is_int((int)$details[3]) == 1) {
                //   echo "CON its a string";
                // }
              $fullName=$details[2];
              $pin=$details[3];
              $lan=$details[1]; 
                 
                  
              switch (is_numeric($details[3])) {  
                // If user selected 1 send them to cash out menu
                 case 1: 
                  registering($details, $lan, $phone, $fullName, $pin);
                  break; 
  
                 case 0:
                  if ($lan == 1) {
                    $ussd_text=" pin contains only numbers \n 98. re-enter pin";
                  }elseif ($lan == 2) {
                    $ussd_text = "Namabala ya chinsisi ikuyenera kukhala manambala okhaokha \n 98. kubwerera mbuyo";
                  }
                  ussd_proceed($ussd_text);  
                 break; 
                 
                }               
               
  
              }
              
              if (count($details)==5)
              {
                
                $lan=$details[1];
                $fullName=$details[2];
                $pin=$details[3];
              
                
                switch ($details[4]) {  
                  // If user selected 1
                  case 1:      
                    // build sql statement
                    $sth = $dbh->prepare("INSERT INTO `sql11437423`.`user` (`name`, `pin`, `phoneNumber`,`language`) VALUES ('$fullName', $pin, $phone, $lan);");
                    //execute insert query   
                    $sth->execute();

                    if ($lan == 1) {
                      $ussd_text="Successful registered";
                    }elseif ($lan == 2) {
                      $ussd_text = "Mwalembesedwa ";
                    }
                    ussd_stop($ussd_text);
                 break; 
  
                 default:
                 choiceCheck($lan);
                 break; 
                }
              
                 
             }
    }

    

  

 ?>  