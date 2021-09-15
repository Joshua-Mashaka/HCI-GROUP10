<?php
require_once('conn.php');

function others($details, $phone, $dbh, $lan){
    if (count($details)==1){
        switch ($lan) {
            case 1:
                $ussd_text = " 1. My pin\n 2. Log checking\n 98. back \n 99. main menu";
                break;
            
            case 2:
                $ussd_text = " 1. kusintha nambala ya chinsinsi\n2. kuyangana matumizidwe\n 98. kubwerera mbuyo \n 99. menyu yoyambirira";
                break;
        }
        
        ussd_proceed($ussd_text);
    }
    if (count($details)>1){
        switch ($details[1]){
            case 1: 
            MyPin($details, $phone, $dbh, $lan);
            break;

            // case 2:
            // MyUsername($details, $phone, $dbh);
            // break;

            case 2:
            LogChecking($details, $phone, $dbh);
            break;


            
            
            default:
                 choiceCheck($lan);
                  break;
        }

    }
}
function MyPin($details, $phone, $dbh, $lan){
    if (count($details)==2){
        switch ($lan) {
            case 1:
                $ussd_text = "Enter old pin \n 98. back \n 99. main menu";
                break;
            
            case 2:
                $ussd_text = "lemban nambala ya chinsinsi ya kale \n 98. kubwerera mbuyo \n 99. menyu yoyambirira ";
                break;
        }
        
        ussd_proceed($ussd_text);

    }
    if (count($details)==3){
            // echo "CON ".$details[2];
            $stmt = $dbh->query("SELECT * FROM 	sql11437423.user where phoneNumber = $phone && pin = $details[2];");
            //        //execute insert query   
            $stmt->execute();
            
            // echo "CON ".$details[2];
            // extract($row);
               while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $oldPin = $row['pin'];
                }
                // echo "CON ". $oldPin . "\n ". $details[2];
                if ($details[2] == $oldPin) {
                    switch ($lan) {
                        case 1:
                            $ussd_text = "Enter new pin \n 98. back \n 99. main menu";
                            break;
                        
                        default:
                        $ussd_text = "lembani nambala ya chinsinsi yatsopano \n 98. kubwerera mbuyo \n 99. menyu yoyambirira";
                            break;
                    }
                    
                    
                    ussd_proceed($ussd_text);
                }else{
                    pincheck($lan);
                }

    }
    if (count($details)==4){

        $oldPin = $details[2];
        $newPin = $details[3];

        $stmt1 = $dbh->query("SELECT * FROM 	sql11437423.user where phoneNumber = $phone && pin = $oldPin;");
            //execute insert query   
            $stmt1->execute();
            
            while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                
                // extract($row);
                
                
                $acc1 = $row['accountNumber']; 
            }
            
            $stmt2 = $dbh->query("UPDATE `	sql11437423`.`user` SET `pin` = $newPin WHERE (`accountNumber` = $acc1);");        
            $stmt2->execute();
            switch ($lan) {
                case 1:
                    $ussd_text = "You have changed your pin from " . $oldPin . " to " . $newPin . " successfully!";
                    break;
                
                default:
                $ussd_text = "Mwakwanirisa kusintha nambala yachinsinsi kuchosa " . $oldPin . " kuika " . $newPin ;
                    break;
            }
        
        ussd_proceed($ussd_text);
    }
}

function ChangeLanguage($details, $phone, $dbh, $lan){
  
    if (count($details)==1){
            switch ($lan) {
                case 1:
                    $ussd_text = "Select language \n 1. English \n 2. Chichewa \n 98. Back 99. Main menu";
                    break;
                
                case 2:
                    $ussd_text = "Sakhani chilakhulo \n 1. English \n 2. Chichewa \n 98. Kubwelera pambuyo \n 99. Menyu yombilira";
                    break;
            }
        
        ussd_proceed($ussd_text);

    }
    if (count($details)==2){

        $stmt1 = $dbh->query("SELECT * FROM sql11437423.user where phoneNumber = $phone;");
        // //execute insert query   
        $stmt1->execute();
        
        while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            
        //     // extract($row);
            
            
            $acc1 = $row['accountNumber']; 
        }
        $lan = $details[1];
        $stmt2 = $dbh->query("UPDATE `sql11437423`.`user` SET `language` = $lan  WHERE (`accountNumber` = $acc1);");        
        $stmt2->execute();

        switch ($lan) {
            case 2:
                $ussd_text = "Your request is submitted successfully. You may restart";
                break;
            
            default:
            $ussd_text = "Pempho lanu latumizidwa. Mutha kuyambiraso";
                break;
        }
        
        ussd_stop($ussd_text);

    }

}

function LogChecking($details, $phone, $dbh){

    $stmt1 = $dbh->query("SELECT * FROM sql11437423.logs where phoneNumber = $phone;");
        // //execute insert query   
        $stmt1->execute();
        echo "END ";
        while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            
        //     // extract($row);
            
            
            echo " ". $row['date']."  ". $row['details']."\n" ;
        }

        // $ussd_text = "changed";
        // ussd_stop($ussd_text);


}

?>