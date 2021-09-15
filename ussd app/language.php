<?php


    function pin($details,$lan){

        switch ($lan) {  
            // If user selected 1 send them to cash out menu
             case 1:      
                $ussd_text = "Enter your pin";
             break; 

             case 2:
                $ussd_text = "Lowetsani nambala yachinsisi :";
             break;  
              
            }
            
        
        ussd_proceed($ussd_text);
    }
    function pincon($details, $lan, $amount, $receiver, $dbh){

        $stmt1 = $dbh->query("SELECT * FROM 	sql11437423.user where phoneNumber = $receiver;");
        //execute insert query   
        $stmt1->execute();

        while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {

           extract($row);

         
           $acc1 = $row['accountNumber'];
           $name = $row['name'];
           $nifo = $row['phoneNumber'];
        }
        if($stmt1->rowCount() > 0)
            {    
                switch ($lan) {  
                    // If user selected 1 send them to cash out menu
                     case 1:      
                      $ussd_text="You are trying to send MK". $amount . " to " . $name ."(".$nifo.") ". " \n enter pin to proceed";  
                     break; 
        
                     case 2:
                      $ussd_text="Mukufuna kutumiza  MK ". $amount . " ku " . $name ."(".$nifo.") ". " : \n Lowetsani nambala ya chinsisi ngati ndizolondola : ";  
                     break;  
                      
                    }
            }else{
                switch ($lan) {
                    case 1:
                        $ussd_text = "The number is not registered. \n 98. Back \n 99. Main menu";
                        break;
                    
                    default:
                    $ussd_text = "Nambala siyolembetsedwa. \n 98. Kubwerera pambuyo \n 99. Menyu yoyambilira";
                        break;
                }
                
            }
            ussd_proceed($ussd_text); 
    }



    function amount($details,$lan){

        switch ($lan) {  
            // If user selected 1 send them to cash out menu
             case 1:      
                $ussd_text = "Enter amount";
             break; 

             case 2:
                $ussd_text = "Lembani mulingo wa ndalama";
             break;  
              
            }
            
        
        ussd_proceed($ussd_text);
       
    }

    function confirm($details, $amount, $lan){

        switch ($lan) {  
            // If user selected 1 send them to cash out menu
             case 1:      
                $ussd_text="You are trying to make a cash out of k ". $amount . " enter pin to proceed ";
             break; 

             case 2:
                $ussd_text="Mwasankha kutapa ndalama zokwana : MK". $amount . " \n Lembani nambala yanu ya chinsisi :  ";  
             break;  
              
            }
          ussd_proceed($ussd_text);
    }

    function sent($details, $balance, $lan, $acc, $receiver, $dbh){

        switch ($lan) {  
            // If user selected 1 send them to cash out menu
             case 1:      
                $ussd_text="successful transaction. balance remaining is MK".$balance. " ";
             break; 

             case 2:                
                $ussd_text="mwakwanirisa kutulusa. ndalama zotsala ndi MK".$balance. " ";  
             break;  
              
            }
            ussd_proceed($ussd_text);
            // echo " kuno";
            
        $stmt1 = $dbh->query("SELECT * FROM 	sql11437423.savedaccount where accountNumber = $acc && savedAccount = $receiver;");
        // //execute insert query   
        $stmt1->execute();

        if($stmt1->rowCount() > 0){
            echo " ";
        }else{
            switch ($lan) {  
                // If user selected 1 send them to cash out menu
                 case 1:      
                    $ussd_texts="Do you want to mark this as your favorite? \n 1. yes \n 2. no";
                 break; 
    
                case 2:
                $ussd_texts="Mufuna kuitsunga nambala yi? \n 1. eya \n 2.ayi";  
                break;  
                  
            }
            echo $ussd_texts;
        }
    }

    
    function displaySend($details, $lan){

        switch ($lan) {  
        //     // If user selected 1 send them to cash out menu
             case "1":      
                $ussd_text = "Select \n 1. To airtel \n 2. to saved accounts \n 3. to mpamba \n 4. to banks";
             break; 

             case "2":                  
                $ussd_text = "Sankhani komwe mukufuna kutumiza ndalama : \n 1.Ku airtel \n 2. Ku nambala yosevedwa kale \n 3. Ku mpamba \n 4. Ku bank ";
             break;  
              
            }
        // $ussd_text = "kkk";
        ussd_proceed($ussd_text);
    }

    function registering($details, $lan, $phone, $fullName, $pin){
        if (strlen($pin) == 4) {
            switch ($lan) {  
            //     // If user selected 1 send them to cash out menu
            case 1:  
                $ussd_text="You are trying to register \n username: ". $fullName . " \n phone number: " . $phone . " \n pin ". $pin . " \n 1. Continue \n 98.Back \n 99. main menu";    
               break; 
    
               case 2:
                $ussd_text=" Mwasankha kulembetsa \n Dzina : ". $fullName . " \n lamya : " . $phone . " \n Nambala ya chinsisi ". $pin . " \n 1. Kuti mulembetse \n 98. Kubwerera mbuyo mbuyo \n 99. menyu yoyambirira ";  
               break;  
                  
            }
        } else {
            switch ($lan) {
            //     // If user selected 1 send them to cash out menu
            case 1:  
                $ussd_text="pin needs to be of 4 digits \n 98. re-enter pin";    
               break; 
    
               case 2:
                $ussd_text="Nambala yachinsisi ikuyenera kukhala ndi manambala anayi \n 98. kubwerera mbuyo";  
               break;  
                  
            }
        }
        
        // $ussd_text = "kkk";
        ussd_proceed($ussd_text);
    }
    
    function enterNumber($details, $lan){

        switch ($lan) {  
           // If user selected 1 send them to cash out menu
            case "1":      
                $ussd_text="Enter phone number:";
            break; 
    
            case "2":
               $ussd_text = "Lembani nambala ya foni :";
            break;  
                  
        }
        ussd_proceed($ussd_text);
    }
    function choiceCheck($lan){

        switch ($lan) {
            case '1':
                echo "CON invalid choice \n98. back \n 99. main menu";
                break;
            
            case '2':
                echo "CON mwasakha molakwika \n 98. kubwerera mbuyo \n 99. menyu yoyambirira";
                break;
        }

    }
    function pincheck($lan){

        switch ($lan) {
            case '1':
                echo "CON invalid pin \n98. back \n 99. main menu";
                break;
            
            case '2':
                echo "CON Mwalowetsa nambala yolakwika \n 98. kubwerera mbuyo \n 99. menyu yoyambirira";
                break;
        }

    }

?>