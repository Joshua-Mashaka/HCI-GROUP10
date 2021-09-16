<?php

//     /* local db configuration */
//     $dsn = 'mysql:dbname=sql11437423;host= sql4.freemysqlhosting.net;'; //database name
//     $user = 'sql11437423'; // your mysql user 
//     $password = 'MD6KPIQJlu'; // your mysql password

//     //  Create a PDO instance that will allow you to access your database
// try {
//     $dbh = new PDO($dsn, $user, $password);
//     // echo "CON connected";
// }
// catch(PDOException $e) {
//     //var_dump($e);
//     echo("PDO error occurred");
// }
// catch(Exception $e) {
//     //var_dump($e);
//     echo("Error occurred");
// }


$servername = "sql11.freemysqlhosting.net";
$username = "sql11437423";
$password = "VUACXi6U3n";

try {
  $dbh = new PDO("mysql:host=$servername;dbname=sql11437423", $username, $password);
  // set the PDO error mode to exception
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "CON Connected successfully";
} catch(PDOException $e) {
//   echo " CON Connection failed: " . $e->getMessage();
}

    //ussd_proceed function for connection     
    function ussd_proceed($ussd_text){
        echo "CON $ussd_text";
        }
     
        //ussd_stop function to end connection    
        function ussd_stop($ussd_text){
        echo "END $ussd_text";
        }

    function check($phone, $pin, $dbh, $lan){
        $stmt = $dbh->query("SELECT * FROM sql11437423.user where phoneNumber = $phone && pin = $pin;");
               //execute insert query   
               $stmt->execute();

               if($stmt->rowCount() > 0)
             {

               while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                  extract($row);

                  switch ($lan) {  
                    // If user selected 1 send them to cash out menu
                     case 1:      
                        echo "END ".$row['name']." as at: ".date("Y/m/d") ." you have a balance of: MK" . $row['balance']. "\n time: ". date("h: i : sa"); 
                     break; 
        
                     case 2:
                        echo "END "."Okondedwa a ".$row['name']." lero pa : ".date("Y-m-d") ."Nthawi : ". date("h:i:sa")." muli ndi ndalama zokwana : MK" . $row['balance']; 
                     break;  
                      
                    }
                }
            }else {
                pincheck($lan);
                
            }
    }

    function save($phone, $pin, $dbh, $savedNumber){

        // build sql statement
        $stmt = $dbh->query("SELECT * FROM sql11437423.user where phoneNumber = $phone && pin = $pin;");
        //execute insert query   
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

           extract($row);

         
           $acc = $row['accountNumber']; 
        }
        // build sql statement
        $sth = $dbh->prepare("INSERT INTO `sql11437423`.`savedaccount` (`accountNumber`, `savedAccount`) VALUES ($acc, $savedNumber);");
        //execute insert query   
        $sth->execute();

        $ussd_text="successful saved";  
        ussd_stop($ussd_text);
    }


    // public function goToMainMenu($text){   
    //     $explodedText = explode("*",$text);
    //     while(array_search(Util::$GO_TO_MAIN_MENU, $explodedText) != false){
    //         $firstIndex = array_search(Util::$GO_TO_MAIN_MENU, $explodedText);
    //         $explodedText = array_slice($explodedText, $firstIndex + 1);
    //     }
    //     return join("*",$explodedText);
    // } 

    // public function goBack($text){           
    //     $explodedText = explode("*",$text);
    //     while(array_search(Util::$GO_BACK, $explodedText) != false){
    //         $firstIndex = array_search(Util::$GO_BACK, $explodedText);
    //         array_splice($explodedText, $firstIndex-1, 2);
    //     }
    //     return join("*", $explodedText);
    // }

    // public function middleware($text){
    //     //remove entries for going back and going to the main menu
    //     return $this->goBack($this->goToMainMenu($text));
    // }

        // function back($ussd_string_explode){
        //     while(array_search("98", $ussd_string_explode, true) !=false){
        //         $index = array_search("98", $ussd_string_explode, true);
        //         array_splice($ussd_string_explode, $index-1,2);
        //         }
        // }

?>