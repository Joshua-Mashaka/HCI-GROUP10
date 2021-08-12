<?php 

   
    // Printing the response as plain text
    header('Content-type: text/plain');

    
    //declaring special variables for the api used  
    $phone = $_POST['phoneNumber'];
    $session_id = $_POST['sessionId'];
    $service_code = $_POST['serviceCode'];
    $ussd_string= $_POST['text'];
      
    $level = 0;    
    $ussd_string_explode = explode("*", $ussd_string);  
    if($ussd_string != ""){  
        $level = count($ussd_string_explode);
    }  
    
     
    if($level == 0){
      displayMenu(); // show the first menu
    }
   
    if ($level>0){  
           switch ($ussd_string_explode[0]) {  
               // If user selected 1 send them to cash out menu
                case 1:  
                Cash_Out($ussd_string_explode,$phone);  
                break; 
                // If user selected 2
                case 2: 
                Make_Payments($ussd_string_explode,$phone);  
                break;  
                 
                 // If user selected 3
                  case 3:  
                    Make_Payments($ussd_string_explode,$phone,$db);  
                  break;

                 // If user selected 4
                  case 4:  
                    Buy_Airtime($ussd_string_explode,$phone,$db);  
                  break; 
               
            }  
    }  
       
       
    //the home menu function
    function displayMenu(){
    $ussd_text ="Welcome to mobile banking\n 1. Cash-Out \n 2. Send Money \n 3. Make Payments \n 4. Buy airtime \n 5. Balance inquiry\n 6. Other Services \n"; 
    ussd_proceed($ussd_text);//calling ussd_proceed function
    }
        
    //ussd_proceed function for connection     
    function ussd_proceed($ussd_text){
    echo "CON $ussd_text";
    }
 
    //ussd_stop function to end connection    
    function ussd_stop($ussd_text){
    echo "END $ussd_text";
    }
    
    //first case progress menus
    function Cash_Out($details,$phone){  
      
         if (count($details)==1)
          {  
            $ussd_text="Enter agent code";  
            ussd_proceed($ussd_text);  
          }  
          
          if(count($details)== 2)
          {
              
              $ussd_text = "Enter amount";
              ussd_proceed($ussd_text);
            }
            
            if (count($details)==3)
             {  
               $ussd_text="You are trying to make a cash out of ". $ussd_string. " enter pin to proceed ";  
               ussd_proceed($ussd_text);  
             }

            if (count($details)==4)
             {  
               $ussd_text="successful transaction";  
               ussd_stop($ussd_text);  
             }
    }

    function Make_Payments($details,$phone){  
      
         if (count($details)==1)
          {  
            $ussd_text ="1. ESCOM \n 2. GOtv \n 3. WATER \n 4. Tuition \n 5. Masm \n 6. MHC\n 7. Others \n"; 
    ussd_proceed($ussd_text);//calling ussd_proceed function
          }  
    }

    function Buy_Airtime($details,$phone) {  

      if(count($details) == 1){  
      $ussd_text = "Select an option \n 1. Top up self  \n 2. other number \n "; 
      ussd_proceed($ussd_text);  
     }  

     else if(count($details) == 2){  
             $Choice=$details[1]; 

         if($Choice=="1"){  
         
             $ussd_text="Enter amount";  
             ussd_proceed($ussd_text);  
           
             
             if (count($details)==3)
              {  
                $ussd_text="You are trying to buy airtime ". $ussd_string. " enter pin to proceed ";  
                ussd_proceed($ussd_text);  
              }
 
             if (count($details)==4)
              {  
                $ussd_text="transaction was successfully made";  
                ussd_stop($ussd_text);  
              }



         }else if($Choice=="2"){  


           $ussd_text="Enter phone number";  
             ussd_proceed($ussd_text);  
           
           if(count($details)== 3)
           {
               
               $ussd_text = "Enter amount";
               ussd_proceed($ussd_text);
             }
             
             if (count($details)==4)
              {  
                $ussd_text="You are trying to buy airtime ". $ussd_string. " enter pin to proceed ";  
                ussd_proceed($ussd_text);  
              }
 
             if (count($details)==5)
              {  
                $ussd_text="transaction was successfully made";  
                ussd_stop($ussd_text);  
              }


         }

     }  

  else {  
         $ussd_text = "wrong input";  
             ussd_proceed($ussd_text);       
       }  
 }

 ?>  