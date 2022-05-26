<?php
include_once "felhasznalok.php";

if (isset($_POST["login"])){
    if (isset($_POST["username"]) && isset($_POST["password"])){
        $login=false;
        foreach ($_SESSION["regFelhasznalok"] as $user) {
            if ($user->getUsername()==$_POST["username"] && $user->getPassword() == $_POST["password"]){
                $login=true;
                $_SESSION["user"]=$user;
                break;
            }
        }
        if (!$login){
            die("<strong>Hiba: </strong>Sikertelen bejelentkezés, valamelyik adat rosszul lett megadva. <a href='bejelentkezes.php'>Vissza a bejelentkezéshez</a>");
        }
    }else{
        die("<strong>Hiba: </strong>Sikertelen bejelentkezés, valamelyik mező nem lett kitöltve. <a href='bejelentkezes.php'>Vissza a bejelentkezéshez</a>");
    }
}
if(isset($_POST["ki"])){
    session_unset();
    session_destroy();
    header("Location: bejelentkezes.php");
}
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css"/>


</head>
<body id="border">

<header>
    <h1>Saját profil</h1>

</header>
<nav>
    <ul>
        <li>
            <a href="bejelentkezes.php" class="aktiv">Bejelentkezés</a>
        </li>


        <?php
        if(!isset($_SESSION["user"])){
            echo '
                <li>
                    <a href="Fő.php" class="link">Főoldal</a>
                </li>
                <li>
                    <a href="Űrlap.php" class="link">Űrlap</a>
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
                    <a href="bejelentkezes.php" class="link">Profil</a>
                </li>
                ';
        }
        ?>
    </ul>
</nav>
<br>
<main>
    <div id="profil">
<?php
if (!isset($_SESSION["user"])){
    echo '


                <p>A profil megtekintéséhez jelentkezzen be</p>
              <form id="bejelentkezes" action="bejelentkezes.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Bejelentkezés</legend>
                <label for = "username">Felhasználónév</label>
                <br>
                <input required type="text" id="username" name="username" tabindex="1"/>
                <br>
                <br>
                <label for = "password">Jelszó</label>
                <br>
                <input required type="password" id="password" name="password" tabindex="2" placeholder="*********"/>
                <br>
                <br>
                <input type="submit" value="Login" name="login"/>
            </fieldset>
        </form>
            ';
         //   header("Location: profil.php"); //atiranyitas a profil.php-ra

        }else  {
            header("Location: profil.php");

        echo '
                <img src="profil/' . $_SESSION["user"]->getKep() . '" alt="profilkep" width="200"/>
                <p>Név:' . $_SESSION["user"]->getUsername() . '</p>
                <p>Email cím:' . $_SESSION["user"]->getEmail() . '</p>
                <p>Telefonszám:' . $_SESSION["user"]->getTelefonszam() . '</p>
                <p>Születési dátum:' . $_SESSION["user"]->getBirthdate() . '</p>
                <form id="kijelentkeze" action="bejelentkezes.php" method="post" enctype="multipart/form-data">
                <input type="submit" value="Kijelentkezés" name="ki"/>
                <br>
                </form>
            ';
    }

        ?>

    </div>
</main>

</body>
</html>