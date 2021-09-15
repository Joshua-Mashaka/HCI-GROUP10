<?php 

    require_once('conn.php');
    
    //first case progress menus
    function saved($details,$phone,$dbh, $lan){  
      
          
            $v = array();
            $u = array();
            $v = array();
            // build sql statement
           //  $stmt = $dbh->query("SELECT * FROM sql4435724.user where accountNumber = 2;");
            $stmt = $dbh->query("SELECT U.name as username,P.name as saved, P.phoneNumber as number FROM sql4435724.user as U join sql4435724.savedaccount as S join sql4435724.user as P where U.accountNumber = S.accountNumber and S.savedAccount = P.phoneNumber and U.phoneNumber = $phone;");
            //execute insert query   
            $stmt->execute();
            $i = 1;
            
            // echo "yadusa";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              
              extract($row);
              $u[$i] = array_push($row, $i);
              
              // echo $row[0]. ".  ". $row['saved'] . "  ". $row['number'] . "\n";
              $v[$i] = $row['number']; 
              $i++;
            }
            
            //  $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //  extract($row);
            
            //  $ussd_text= $row['balance'];  
            //  ussd_stop($ussd_text);  
            if(count($details)== 2){
              echo "CON ";
              $i = 1;
              $stmt->execute();
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                extract($row);
                $u[$i] = array_push($row, $i);
                
                echo $row[0]. ".  ". $row['saved'] . "  ". $row['number'] . "\n";
                // $v[$i] = $row['number']; 
                $i++;
              }
              // echo "CON ". $v[4];
            }

            if(count($details)== 3)
         {
          amount($details,$lan);
           }
           
           if (count($details)==4)
            {  

               
             $receiver=$v[$details[2]];
             $amount=$details[3];
              
              
             pincon($details, $lan, $amount, $receiver);
            }
             
           if (count($details)==5)
            {
               
               $receiver=$v[$details[2]];
               $amount=$details[3];
               $pin = $details[4];
             
              // // build sql statement
              // $sth = $dbh->prepare("INSERT INTO `sql4435724`.`user` (`name`, `pin`, `phoneNumber`) VALUES ('$fullName', $pin, $phone);");
              // //execute insert query   
              // $sth->execute();
              transaction($dbh,$phone,$pin,$amount,$receiver,$lan);
              // $ussd_text="successful transferred";  
              // ussd_stop($ussd_text);  
            }
              // if (count($details)== 3) {
              //   // echo "END y". $v[4];
              //   // echo "END yyy";

              // }
    }

    

  

 ?>  