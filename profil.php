
<?php

include_once "User.php";
include_once "felhasznalok.php";


if (!isset($_SESSION["user"])) {
    header("Location: Űrlap.php");

}

$accounts = [
    [
        "username" => "András",
        "password" => "András12",
        "password2" => "András12",
        "birthdate" => "2001.08.01.",
        "email" => "andras@gmail.com",
        "phone_number" => "12345678",
        "nineties" => ["choose1"],
        "two_thousand_years" => ["choose2"],
        "two_thousand_and_ten_years" => ["choose3"],

    ]
];


?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">


</head>
<body id="border">

<header>
    <h1>Bejelentkezés</h1>
</header>
<nav>
    <ul>
        <li>
            <a href="Fő.php" class="link">Főoldal</a>
        </li>

        <?php
        if(!isset($_SESSION["user"])){
            echo '
                <li>
                    <a href="Űrlap.php" class="link">Űrlap</a>
                </li>
                <li>
                    <a href="bejelentkezes.php" class="link">Bejelentkezés</a>
                </li>
                ';
        }else{
            echo '
                <li>
                    <a href="1990-1999.php" class="link">1990-1999</a>
                </li>
                <li>
                    <a href="2000-2009.php" class="link">2000-2009</a>
                </li>
                <li>
                    <a href="2010-2019.php" class="link">2010-2019</a>
                </li>
                <li>
                    <a href="bejelentkezes.php" class="aktiv">Profil</a>
                </li>
                ';
        }
        ?>
    </ul>
</nav>
<main>


    Sikeres belépés <br>
    <?php
    $username= "";
    $password= "";
    $email= "";
    $telefonszam= "";
    $birthdate= "";
    $kep= "";

    if (isset($_POST["login"])) {
        $username=$_POST["username"];
        $password=$_POST["password"];
        $email=$_POST["email"];
        $telefonszam=$_POST["telefonszam"];
        $birthdate=$_POST["birthdate"];
        $kep=$_POST["kep"];
    }

    $newUser = new User($username,$password,$email,$telefonszam,$birthdate,$kep);
?>


<?php

$newUser ->udvozol();

     echo '
                <img src="img/' . $_SESSION["user"]->getKep() . '" alt="profilkep" height="200" width="250"/>
                <p>Név:' . $_SESSION["user"]->getUsername() . '</p>
                <p>Email cím:' . $_SESSION["user"]->getEmail() . '</p>
                <p>Telefonszám:' . $_SESSION["user"]->getTelefonszam() . '</p>
                <p>Születési dátum:' . $_SESSION["user"]->getBirthdate() . '</p>
                <form id="kijelentkeze" action="bejelentkezes.php" method="post" enctype="multipart/form-data">
                <input type="submit" value="Kijelentkezés" name="ki"/>
                <br>
                </form>
            ';


?>


                <br>
                </form>



</main>

</body>
</html>

