<?php

    require_once('conn.php');
    require_once('register.php');
    require_once('balance.php');
    require_once('cashOut.php');
    require_once('sendMoney.php');
    require_once('transanction.php');
    require_once('saved.php');
    require_once('log.php');
    require_once('language.php');
    require_once('others.php');
    require_once('buy_airtime.php');
   
    // Printing the response as plain text
    header('Content-type: text/plain');
    date_default_timezone_set("Africa/Johannesburg");

    
    //declaring special variables for the api used  
    $phon = $_POST['phoneNumber'];
    $session_id = $_POST['sessionId'];
    $service_code = $_POST['serviceCode'];
    $ussd_string= $_POST['text'];
    $phone = "0". substr($phon, 4);
      
    $level = 0;    
    $ussd_string_explode = explode("*", $ussd_string);  
    if($ussd_string != ""){  
        $level = count($ussd_string_explode);
    }

        while(array_search("98", $ussd_string_explode, true) !=false){
        $index = array_search("98", $ussd_string_explode, true);
        array_splice($ussd_string_explode, $index-1,2);
        $level--;
        }
    


    while(array_search("99",$ussd_string_explode, true) !=false){
        $index = array_search("99",$ussd_string_explode, true);
        array_splice($ussd_string_explode,0,$index+1);
        // reset($ussd_string_explode);
        $level = 1;
    }
    // echo "CON ".$level;
    // print_r($ussd_string_explode);
    $ussd_string = join("*",$ussd_string_explode);

    // if (empty($ussd_string_explode)) {
    //   displayMenu($lan);
    // }

    $stmt = $dbh->query("SELECT * FROM 	sql11437423.user where phoneNumber = $phone;");
    //execute insert query   
    $stmt->execute();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      extract($row);

    
      $lan = $row['language']; 
    }
    // echo "CON " .$lan;
        if($stmt->rowCount() > 0)
          {
            if($level == 0 || empty($ussd_string_explode)){
              // echo "CON izi". $phon ." zantha";
              displayMenu($lan); // show the first menu
            }

            if ($level>0){  
              switch ($ussd_string_explode[0]) {  
                  // If user selected 1 send them to cash out menu
                   case 1:  
                   Cash_Out($ussd_string_explode,$phone,$dbh, $lan);  
                   break; 
                   // If user selected 2 for send money
                   case 2: 
                   sendMoney($ussd_string_explode,$phone,$dbh, $lan);  
                   break;  
                    
                    // If user selected 3
                     case 3:  
                       Make_Payments($ussd_string_explode,$phone,$dbh, $lan);  
                     break;
   
                    // If user selected 4
                     case 4:  
                      buy_airtime($ussd_string_explode,$phone,$dbh, $lan);  
                     break; 
                    // If user selected 5
                     case 5:  
                      check_balance($ussd_string_explode,$phone,$dbh,$lan);  
                     break; 
                     //if user select 6
                     case 6;
                      ChangeLanguage($ussd_string_explode, $phone, $dbh, $lan);
                    break;
                    // If user selected 7
                     case 7:  
                      others($ussd_string_explode,$phone,$dbh,$lan);  
                     break;
                     
                     default:
                     if (!empty($ussd_string_explode)) {
                      choiceCheck($lan);
                     }
                     break;
                  
              }  
           }  
    
          }
          

         else {
          if($level == 0 || empty($ussd_string_explode)){
            echo "CON This number is not registered to the platform \n Enter 1 to register";
          }
            if ($level>0){  
              switch ($ussd_string_explode[0]) {  
                  // If user selected 1 send them to cash out menu
                   case 1:  
                   register($ussd_string_explode,$phone,$dbh);  
                   break;
                   default:
                  //  $x = $level;
                   if ($level == 1 && $ussd_string_explode[0] != "" ) {
                     echo "CON Invalid input. \n 99. To restart the process \n Click on cancel to exit";
                    //  echo "CON ...n";
                  }
                   break; 
                  
               }  
              }
          
       
          }
     
   
    // if ($level>0){  
    //        switch ($ussd_string_explode[0]) {  
    //            // If user selected 1 send them to cash out menu
    //             case 1:  
    //             check_balance($ussd_string_explode,$phone,$dbh);  
    //             break; 
               
    //         }  
    // }  
       
       
    //the home menu function
    function displayMenu($lan){
        if ($lan == "1") {
      $ussd_text ="Welcome to mobile banking\n 1. Cash-Out \n 2. Send Money \n 3. Make Payments \n 4. Buy airtime/bundle \n 5. Balance inquiry\n 6. Change language \n 7. Other Services \n"; 
      // ussd_proceed($ussd_text);//calling ussd_proceed function
      }
      elseif ($lan == "2") {
        
        $ussd_text ="Takulandilani akasitomala Sankhani :  \n 1. Kutapa ndalama \n 2. Kutumiza ndalama \n 3. Kulipira ma bilu \n 4. Kugula mayunitsi/bandulo \n 5. Kuona ndalama zotsala\n 6. Kusitha chilakhulo\n 7. Zina ndi zina \n"; 
      }
      ussd_proceed($ussd_text);//calling ussd_proceed function
    }
    function Make_Payments($details,$phone,$db, $lan){

      if (count($details)==1)
     {

      switch ($lan) {
        case 1:
          $ussd_text ="Please select:\n 1. Water \n 2. Escom \n 3. TV \n 4. Medical aid \n 5. Betting \n 6. MHC \n 98. Back \n 99. Main menu";
          break;
        
        case 2:
          $ussd_text ="Sankhani :  \n 1. Madzi \n 2. Magetsi \n 3. TV \n 4. Zaumoyo \n 5. Kubetcha\n 6. Nyumba za boma \n 98. Kubwelera pambuyo \n 99. Menyu yoyambilira";
          break;
      }
      
      ussd_proceed($ussd_text);//calling ussd_proceed function
    }
      if (count($details)>1)
     {

      switch ($lan) {
        case 1:
          $ussd_text ="Not yet implemented \n will be liaised by the service providers\n 99. Main menu";
          break;
        
        case 2:
          $ussd_text ="Sizanakonzedwe \n Zilongosoledwa ndi eni netiweki \n 99. Menyu yoyambilira";
          break;
      }
      
      ussd_proceed($ussd_text);//calling ussd_proceed function
    }
  }
      
    // }
 

 ?>  