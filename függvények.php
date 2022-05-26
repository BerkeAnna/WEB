<!--- valami nem jo a 11. sorban-->
<?php

function loadUsers($filename){
    $users = []; //ez tartalmazza a felhasznalokat
    $file= fopen($filename, "r"); //hozzairasra
    if($file===FALSE)           //ha hamis, hiabauzenetet ad
        die("A fájlt nem sikerult megnyitni!");

    while (($line = fgets($file)) !== FALSE) {      //amig nem hamis, soronkent beolvas
        $user = unserialize($line);
        $users[] = $user;            //hozzaadas a users tombhoz
    }
    fclose($file);           //fajl zarasa
    return $users;
}

    function saveUser($filename, $users){   //felhasznalo mentes fajlba
       $file= fopen($filename, "w"); //irasra
        if($file===FALSE){              //ha hamis, hiabauzenetet ad
            die("A fájlt nem sikerult megnyitni!");
        }
       foreach ($users as $user){
           fwrite($file,  serialize($user) . "\n");  //kiirjuk a kimeneti fajlba
       }
       fclose($file);
    }



?>
