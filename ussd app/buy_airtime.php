<?php
require_once('conn.php');

function buy_airtime($details, $phone, $dbh, $lan){

    if (count($details)==1){
        switch ($lan) {
            case 1:
                $ussd_text = " 1. Buy airtime\n 2. Buy bundles\n 98. Back\n 99. Main menu ";
                break;
            
            case 2:
                $ussd_text = " 1. Kugula mayunitsi \n 2. Kugula bandulo \n 98. Kubwelera m'mbuyo \n 99. Menyu yoyambilira";
                break;
        }
       
    }
        if (count($details)==2){
            switch ($lan) {
                case 1:
                    $ussd_text = "Please select:\n 1. For your number\n 2. For another number\n98. Back\n 99. Main menu";
                    break;
                
                case 2:
                    $ussd_text = "Sankhani \n 1.Pa nambala yanu\n 2. kugulira ena \n 98. Kubwelera pambuyo\n 99. Menyu yoyambilira";
                    break;
            }
        
            
    
    }
    ussd_proceed($ussd_text);
    if (count($details)>1){
        switch ($details[1]){
            case 1: 
            BuyAirtime($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            BuyBundles($details, $phone, $dbh, $lan);
            break;
            }
    }
    }
    function BuyAirtime($details, $phone, $dbh, $lan){
        
            
        if (count($details)>2){
            switch ($details[2]){
                case 1: 
                ForSelf($details, $phone, $dbh, $lan);
                break;
        
                case 2:
                ForOthers($details, $phone, $dbh, $lan);
                break;
                }
        }
    
    }
    function ForSelf($details, $phone, $dbh, $lan){
        if (count($details)==3){
            amount($details,$lan);
           
        }
        if (count($details)==4){
    
            $amount = $details[3];
            
            switch ($lan) {
                case 1:
                    $ussd_text = "Are you sure you want to buy MWK" . $amount . " credit for your number? Enter pin to proceed\n 98. Back \n 99. Main menu";
                    break;
                
                case 2:
                    $ussd_text = "Mukutsimikiza kugula mayunitsi okwana MWK" . $amount . "Ku nambala yanu?\n Lembani nambala yachisinsi\n 98. Kubwelera pambuyo \n 99. Menyu yoyambilira ";
                    break;
            }
           
    
        }
    
    }
    function ForOthers($details, $phone, $dbh, $lan){
        if (count($details)==3){
            enterNumber($details, $lan);
    
        }
        if (count($details)==4){
            amount($details,$lan);
    
        }
        if (count($details)==5){

    
            $receiver = $details[3];
            $amount = $details[4];
            
            switch ($lan) {
                case 1:
                    $ussd_text = "Are you sure you want to buy MWK" . $amount . " credit for " . $receiver . "? Enter pin to proceed\n";
                    break;
                
                case 2:
                    $ussd_text = "Mukutsimikiza kugula mayunitsi okwana MWK" . $amount . " Ku nambala " . $receiver . "? Lembani nambala yachisinsi\n 98. Kubwelera pambuyo \n 99. Menyu yoyambilira ";
                    break;
            }        
           
    
        }
    }
    
function BuyBundles($details, $phone, $dbh, $lan){
    if (count($details)==2){

        switch($lan){
            case 1:
                $ussd_text = "Please select\n 1. For your number\n 2. For another number\n 98. back \n 99. Main menu";
                break;

            case 2:
                $ussd_text = "Sankhani 1. ku nambala yanga\n 2. ku nambala ya wena\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }
        
    }
    if (count($details)>2){
        switch ($details[2]){
            case 1: 
            ForYourself($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            ForOtherPeople($details, $phone, $dbh, $lan);
            break;
            }
    }

}
function ForYourself($details, $phone, $dbh, $lan){
    if (count($details)==3){

        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Internet bundles\n2. Voice bundles\n3. SMS bundles\n98. back \n99. main menu";
                break;

            case 2:
                $ussd_text = "Sankhani\n1. Bandulo la intaneti\n2. Mphindi zoyankhulira \n3. Ticheze sms \n 98. Kubwelera pambuyo\n 99. Menyu yoyambilira";
                break;
        }
        ussd_proceed($ussd_text);

    }
    if (count($details)>3){
        switch ($details[3]){
            case 1: 
            Internet($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            Voice($details, $phone, $dbh, $lan);
            break;
            case 3;
            Sms($details, $phone, $dbh, $lan);
            break;
            }
    }

}
function Internet($details, $phone, $dbh, $lan){
    if (count($details)==4){
        
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Panet Volume\n2. Panet Social\n 98. Back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. Bandulo ya intaneti \n 2. Bandulo ya masamba a chenzo\n 98. Kubwelera pambuyo \n 99. Menyu yoyambilira ";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>4){
        switch ($details[4]){
            case 1: 
            Volume($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            Social($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function Volume($details, $phone, $dbh, $lan){
    if (count($details)==5){
        
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Panet volume daily MWK300\n2. Panet volume weekly MWK 1500\n3. Panet volume monthly MWK 2500\n98. Back \n99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. Bandulo ya tsiku MWK300\n2. Bandulo ya pasabata MWK 1500\n3. Bandulo ya mwezi MWK 2500\n 98. Kubwelera pambuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>5){
        switch ($details[5]){
            case 1: 
            dailyVolume($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyVolume($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyVolume($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function dailyVolume($details, $phone, $dbh, $lan){
    if (count($details)==6){

        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily volume bundle for your number? Enter pin to proceed\n98. Back \n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yatsiku ku nambala yanu? Lembani nambala yachinsisi kuti mupitilize\ 98. kubwelera pambuyo \n ";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyVolume($details, $phone, $dbh, $lan){
    if (count($details)==6){

        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly volume bundle for your number? Enter pin to proceed\n \n 98. back \n 99. main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ku nambala yanu? Lembani nambala yachinsisi kuti mupitilize\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyVolume($details, $phone, $dbh, $lan){
    if (count($details)==6){

        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly volume bundle for your number? Enter pin to proceed\n 98. back \n 99. main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yamwezi ku nambala yanu? Lembani nambala yachinsisi kuti mupitilize\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function Social($details, $phone, $dbh, $lan){
    if (count($details)==5){
        
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Whatsapp bundles\n2. Facebook bundles\n3. Social combo bundles\n 98. back \n 99. main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. bandulo ya Whatsapp\n2. bandulo ya Facebook\n3. Social combo bundles\n 98. kubwerera mbuyo \n 99. menu yoyambirira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>5){
        switch ($details[5]){
            case 1: 
            whatsapp($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            facebook($details, $phone, $dbh, $lan);
            break;

            case 3:
            socialCombo($details, $phone, $dbh, $lan);
            break;

            }
    }
}
function whatsapp($details, $phone, $dbh, $lan){
    if (count($details)==6){
        
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Daily bundles\n2. Weekly bundles\n3. Monthly bundles\n 98. back \n 99. main menu ";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. bandulo la tsiku\n2. bandulo la sabata\n3. bandulo la mwezi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>6){
        switch ($details[6]){
            case 1: 
            dailyWhatsapp($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyWhatsapp($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyWhatsapp($details, $phone, $dbh, $lan);
            break;

            }
    }

}
function dailyWhatsapp($details, $phone, $dbh, $lan){
    if (count($details)==7){
        
        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily whatsapp bundle for your number, MWK100.00 will be deducted from your account?\n Enter pin to proceed\n 98. back \n 99. main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yatsiku ya whatsapp ku nambala yanu, MWK100 ichotseredwa ichotseredwa ku akaunti kwanu?\n lowetsani nambala ya chinsinsi\n 98. kubwera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyWhatsapp($details, $phone, $dbh, $lan){
    if (count($details)==7){
        
        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly whatsapp bundle for your number, MWK300.00 will be deducted from your account?\n Enter pin to proceed\n 98. back \n 99. main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yawiki ya whatsapp ku nambala yanu, MWK300.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n98. kubwerera mbuyo \n 99. menu yoyambirira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyWhatsapp($details, $phone, $dbh, $lan){
    if (count($details)==7){
        
        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly whatsapp bundle for your number, MWK560.00 will be deducted from your account?\n Enter pin to proceed\n 98. back \n 99. main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yamwezi ya whatsapp ku nambala yanu, MWK560.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function facebook($details, $phone, $dbh, $lan){
    if (count($details)==6){
        
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1.  Daily bundles\n2. Weekly bundles\n3. Monthly bundles\n 98. back \n 99. main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1.  Bandulo yapatsiku\n2. Bandulo yapasabata\n3. Bandulo yapamwezi\n 98. kubwelera pambuyo \n 99. Menyu yoyambilira";

                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>6){
        switch ($details[6]){
            case 1: 
            dailyFacebook($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyFacebook($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyFacebook($details, $phone, $dbh, $lan);
            break;

            }
    }

}
function dailyFacebook($details, $phone, $dbh, $lan){
    if (count($details)==7){
  
        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily facebook bundle for your number, MWK110.00 will be deducted from your account?\n Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya facebook ku nambala yanu, MWK110.00 ichotseredwa ku account yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyFacebook($details, $phone, $dbh, $lan){
    if (count($details)==7){
              
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly facebook bundle for your number, MWK240.00 will be deducted from your account?\n Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ya facebook ku nambala yanu, MWK240.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyFacebook($details, $phone, $dbh, $lan){
    if (count($details)==7){
       
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly facebook bundle for your number, MWK1200.00 will be deducted from your account?\n Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya facebook ku nambala yanu, MWK1200.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function socialCombo($details, $phone, $dbh, $lan){
    if (count($details)==6){
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Daily bundles\n2. Weekly bundles\n3. Monthly bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. Bandulo yapatsiku\n2. Bandulo yapasabata\n3. Bandulo yapamwezi\n 98. kubwelera pambuyo\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>6){
        switch ($details[6]){
            case 1: 
            dailySC($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklySC($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlySC($details, $phone, $dbh, $lan);
            break;

            }
    }

}
function dailySC($details, $phone, $dbh, $lan){
    if (count($details)==7){
       
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily social combo bundle for your number, MWK150 will be deducted from your account?\n Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya social combo ku nambala yanu, MWK150.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklySC($details, $phone, $dbh, $lan){
    if (count($details)==7){
       
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly social combo bundle for your number, MWK350 will be deducted from your account?\n Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ya social combo ku nambala yanu, MWK350.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlySC($details, $phone, $dbh, $lan){
    if (count($details)==7){
       
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly social combo bundle for your number, MWK1200 will be deducted from your account?\n Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya social combo ku nambala yanu, MWK1200.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}

function Voice($details, $phone, $dbh, $lan){
    if (count($details)==4){
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Chezani daily voice bundles\n2. Chezani weekly voice bundles\n3. Chezani monthly voice bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. Chezani voice bandulo yapatsiku\n2. Chezani voice bandulo yapasabata\n3. Chezani voice bandulo yapamwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>4){
        switch ($details[4]){
            case 1: 
            dailyVoicee($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyVoice($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyVoice($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function dailyVoice($details, $phone, $dbh, $lan){
    if (count($details)==5){

        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily voice bundle for your number for 18 minutes, MWK200.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula voice bandulo yapatsiku ku nambala yanu ya mphindi 18, MWK200.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyVoice($details, $phone, $dbh, $lan){
    if (count($details)==5){

        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly voice bundle for your number for 45 minutes, MWK500.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula voice bandulo yapasabata ku nambala yanu ya mphindi 45, MWK500.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyVoice($details, $phone, $dbh, $lan){
    if (count($details)==5){

        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly voice bundle for your number for 110 minutes, MWK1500.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula voice bandulo yapamwezi ku nambala yanu ya mphindi 110, MWK1500.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function Sms($details, $phone, $dbh, $lan){
    if (count($details)==4){
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Daily SMS bundle\n2. Weekly SMS bundle Social\n3. Monthly SMS bundle\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. SMS bandulo patsiku\n2.  SMS bandulo pasabata\n3.  SMS bandulo pamwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>4){
        switch ($details[4]){
            case 1: 
            dailySms($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklySms($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlySms($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function dailySms($details, $phone, $dbh, $lan){
    if (count($details)==5){

        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily SMS bundle for your number for 150 texts, MWK30.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya SMS ku nambala yanu kugula ma meseji 150, MWK30.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklySms($details, $phone, $dbh, $lan){
    if (count($details)==5){

        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly SMS bundle for your number for 750 texts, MWK80.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ya SMS ku nambala yanu kugula ma meseji 750, MWK80.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlySms($details, $phone, $dbh, $lan){
    if (count($details)==5){

        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly SMS bundle for your number for 4000 texts, MWK400.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya SMS ku nambala yanu kugula ma meseji 4000, MWK400.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function ForOtherPeople($details, $phone, $dbh, $lan){
    if (count($details)==3){
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Internet bundles\n2. Voice bundles\n3. SMS bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. Bandulo ya intaneti\n2. Voice bandulo\n3. SMS bandulo\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }
    if (count($details)>3){
        switch ($details[3]){
            case 1: 
            InternetFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            VoiceFOP($details, $phone, $dbh, $lan);
            break;
            case 3;
            SmsFOP($details, $phone, $dbh, $lan);
            break;
            }
    }

}
function InternetFOP($details, $phone, $dbh, $lan){
    if (count($details)==4){
        
        switch($lan){
            case 1:
                $ussd_text = "Please select \n 1. Panet Volume \n 2. Panet Social\n 98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n 1. Bandulo ya intaneti \n 2. Intaneti ya tsamba lamchezo \n 98. kubwerera pambuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>4){
        switch ($details[4]){
            case 1: 
            VolumeFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            SocialFOP($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function VolumeFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Panet volume daily\n2. Panet volume weekly\n3. Panet volume monthly\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. Panet volume patsiku\n2. Panet volume pasabata\n3. Panet volume pamwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>5){
        switch ($details[5]){
            case 1: 
            dailyVolumeFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyVolumeFOP($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyVolumeFOP($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function dailyVolumeFOP($details, $phone, $dbh, $lan){
    if (count($details)==6){
        enterNumber($details, $lan);
    }
    if (count($details)==7){

        $receiver = $details[6];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily volume bundle for ". $receiver .", MWK300.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya volume ku nambala ". $receiver ."? MWK300.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyVolumeFOP($details, $phone, $dbh, $lan){
    if (count($details)==6){
        enterNumber($details, $lan);
    }
    if (count($details)==7){
        $receiver = $details[6];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly volume bundle for " . $receiver . ", MWK1500.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ya volume ku nambala " . $receiver . ", MWK1500.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyVolumeFOP($details, $phone, $dbh, $lan){
    if (count($details)==6){
        enterNumber($details, $lan);
    }
    if (count($details)==7){
        $receiver = $details[6];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly volume bundle for " . $receiver . ", MWK2500.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya volume ku nambala " . $receiver . "?, MWK2500.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function SocialFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        
        switch($lan){
            case 1:
                $ussd_text = "Please select\n1. Whatsapp bundles\n2. Facebook bundles\n3. Social combo bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Sankhani\n1. Whatsapp bundles\n2. Facebook bundles\n3. Social combo bundles\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>5){
        switch ($details[5]){
            case 1: 
            whatsappFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            facebookFOP($details, $phone, $dbh, $lan);
            break;

            case 3:
            socialComboFOP($details, $phone, $dbh, $lan);
            break;

            }
    }
}
function whatsappFOP($details, $phone, $dbh, $lan){
    if (count($details)==6){
        
        switch($lan){
            case 1:
                $ussd_text = "Whatsapp bundles\n1.  Daily bundles\n2. Weekly bundles\n3. Monthly bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Ma bandulo a whatsapp\n1. Bandulo yapatsiku\n2. Bandulo yapasabata\n3. Bandulo yapamwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>6){
        switch ($details[6]){
            case 1: 
            dailyWhatsappFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyWhatsappFOP($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyWhatsappFOP($details, $phone, $dbh, $lan);
            break;

            }
    }

}
function dailyWhatsappFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily whatsapp bundle for " . $receiver . ", MWK100.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya whatsapp ku nambala " . $receiver . ", MWK100.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyWhatsappFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly whatsapp bundle for " . $receiver . ", MWK300.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ya whatsapp ku nambala " . $receiver . ", MWK300.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyWhatsappFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly whatsapp bundle for " . $receiver . ", MWK560.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya whatsapp ku nambala " . $receiver . ", MWK560.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function facebookFOP($details, $phone, $dbh, $lan){
    if (count($details)==6){
        
        switch($lan){
            case 1:
                $ussd_text = "Facebook bundles\n1.  Daily bundles\n2. Weekly bundles\n3. Monthly bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Ma bandulo a facebook\n1. Bandulo yapatsiku\n2. Bandulo yapasabata\n3. Bandulo yapamwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>6){
        switch ($details[6]){
            case 1: 
            dailyFacebookFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyFacebookFOP($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyFacebookFOP($details, $phone, $dbh, $lan);
            break;

            }
    }

}
function dailyFacebookFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily facebook bundle for " . $receiver . ", MWK110.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya facebook ku nambala " . $receiver . ", MWK110.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyFacebookFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly facebook bundle for " . $receiver . ", MWK240.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ya facebook ku nambala " . $receiver . ", MWK240.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyFacebookFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly facebook bundle for " . $receiver . ", MWK1200.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya facebook ku nambala " . $receiver . ", MWK1200.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function socialComboFOP($details, $phone, $dbh, $lan){
    if (count($details)==6){
        
        switch($lan){
            case 1:
                $ussd_text = "Social Combo bundles\n1. Daily bundles\n2. Weekly bundles\n3. Monthly bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Ma bandulo a social combo\n1. Bandulo yapatsiku\n2. Bandulo yapasabata\n3. Bandulo yapamwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>6){
        switch ($details[6]){
            case 1: 
            dailySCFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklySCFOP($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlySCFOP($details, $phone, $dbh, $lan);
            break;

            }
    }

}
function dailySCFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily social combo bundle for " . $receiver . ", MWK150.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya social combo ku nambala " . $receiver . ", MWK350.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklySCFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly social combo bundle for " . $receiver . ", MWK350.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapasabata ya social combo ku nambala " . $receiver . ", MWK350.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlySCFOP($details, $phone, $dbh, $lan){
    if (count($details)==7){
        enterNumber($details, $lan);
    }
    if (count($details)==8){
        $receiver = $details[7];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly social combo bundle for " . $receiver . ", MWK1200.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya social combo ku nambala " . $receiver . ", MWK1200.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function VoiceFOP($details, $phone, $dbh, $lan){
    if (count($details)==4){
        
        switch($lan){
            case 1:
                $ussd_text = "Voice bundles\n1. Chezani daily voice bundles\n2. Chezani weekly voice bundles\n3. Chezani monthly voice bundles\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Voice bandulo\n1. Chezani voice bandulo yapatsiku\n2. Chezani voice bandulo yapasabata\n3. Chezani voice bandulo yapamwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>4){
        switch ($details[4]){
            case 1: 
            dailyVoiceFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklyVoiceFOP($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlyVoiceFOP($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function dailyVoiceFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        enterNumber($details, $lan);
    }
    if (count($details)==6){
        $receiver = $details[5];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily voice bundle for " . $receiver . " for 18 minutes, MWK200.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula voice bandulo yapatsiku ku nambala " . $receiver . " ya mphindi 18, MWK200.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklyVoiceFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        enterNumber($details, $lan);
    }
    if (count($details)==6){
        $receiver = $details[5];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly voice bundle for " . $receiver . " for 45 minutes, MWK500.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula voice bandulo yapasabata ku nambala " . $receiver . " ya mphindi 45, MWK500.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlyVoiceFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        enterNumber($details, $lan);
    }
    if (count($details)==6){
        $receiver = $details[5];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly voice bundle for " . $receiver . " for 110 minutes, MWK1500.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula voice bandulo yapamwezi ku nambala " . $receiver . " ya mphindi 110, MWK1500.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function SmsFOP($details, $phone, $dbh, $lan){
    if (count($details)==4){
        
        switch($lan){
            case 1:
                $ussd_text = "SMS bundles\n1. Daily SMS bundle\n2. Weekly SMS bundle Social\n3. Monthly SMS bundle\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "SMS bandulo\n1. SMS bundle yapatsiku\n2. SMS bundle yapa sabata\n3. SMS bundle yapa mwezi\n98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);
    }
    if (count($details)>4){
        switch ($details[4]){
            case 1:                                                             
            dailySmsFOP($details, $phone, $dbh, $lan);
            break;
    
            case 2:
            weeklySmsFOP($details, $phone, $dbh, $lan);
            break;

            case 3:
            monthlySmsFOP($details, $phone, $dbh, $lan);
            break;
            }
    }
}
function dailySmsFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        enterNumber($details, $lan);

    }
    if (count($details)==6){
        $receiver = $details[5];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy daily SMS bundle for " . $receiver . " for 150 texts, MWK30.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapatsiku ya SMS ku nambala " . $receiver . " kugula ma meseji 150, MWK30.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function weeklySmsFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        enterNumber($details, $lan);
    }
    if (count($details)==6){
        $receiver = $details[5];
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy weekly SMS bundle for " . $receiver . " for 750 texts, MWK80.00 will be deducted from your account? Enter pin to proceed\n98. back\n 99. Main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapaweek ya SMS ku nambala " . $receiver . " kugula ma meseji 750, MWK80.00  ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
function monthlySmsFOP($details, $phone, $dbh, $lan){
    if (count($details)==5){
        enterNumber($details, $lan);

    }
    if (count($details)==6){
        $receiver = $details[5];
        
        
        switch($lan){
            case 1:
                $ussd_text = "Are you sure you want to buy monthly SMS bundle for " . $receiver . " for 4000 texts, MWK400.00 will be deducted from your account? Enter pin to proceed\n 98. back \n99. main menu";
                break;
            case 2:
                $ussd_text = "Mukutsimikiza kuti mukufuna kugula bandulo yapamwezi ya SMS ku nambala " . $receiver . " kugula ma meseji 4000, MWK400.00 ichotseredwa ku akaunti yanu?\n lowetsani nambala ya chinsinsi\n 98. kubwerera mbuyo \n 99. Menyu yoyambilira";
                break;
        }

        ussd_proceed($ussd_text);

    }

}
?>