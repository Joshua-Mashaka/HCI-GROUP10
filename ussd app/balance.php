<?php 
   
   require_once('conn.php'); 

    //first case progress menus
    function check_balance($details,$phone,$dbh,$lan){  
      
          
          if(count($details)== 1)
          {
            pin($details,$lan);
            }
            
              
              if (count($details)==2)
              {
                
                
                $pin=$details[1];
                check($phone, $pin, $dbh, $lan);
              
                  
             }
             if (count($details)>=3) {
              switch ($details[2]) {
                case '98':
                  
                  break;
                
                default:
                  echo "CON be serious";
                  break;
              }
          }
    }

    

  

 ?>  