<?php
include_once "User.php";
session_start();
$file = fopen("users.txt","a+"); //megnyitja olvasasra es irasra a fajlt
$_SESSION["regFelhasznalok"] = [];
while (($line = fgets($file)) !== false) {
    $sor = unserialize($line); //sor beolvasása és visszaalakítása PHP értékké
    $newUser = new User($sor["username"],$sor["password"],$sor["email"],$sor["telefonszam"],$sor["birthdate"],$sor["kep"]); //newUser letrehozasa
    array_push($_SESSION["regFelhasznalok"],$newUser);  //beszurja a newUsert a SESSION["regFelhasznalok"] vegere
}

fclose($file);


?>