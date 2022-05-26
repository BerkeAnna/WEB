<?php
include_once "felhasznalok.php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Főoldal</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<header>
   <h1>Minden idők legkedveltebb videójátékai</h1>
</header>
<nav>
    <ul>
        <li>
            <a href="Fő.php" class="aktiv">Főoldal</a>
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
                    <a href="bejelentkezes.php" class="link">Profil</a>
                </li>
                ';
            }
            ?>
    </ul>
</nav>
<br>
    <main>
        <div id="animacio"></div>
        <h2 id="hely">Üdvözlünk a gamerek időgépében </h2>
        <p id="forma">Ezen az oldalon visszatekinthetsz a legkedveltebb játékokra, amelyekkel valószínű már te is játszottál. <br>
            Sok olyan videojáték, amelyet a játékosok játszanak és ápolnak. Számtalan világ és felfedezésre váró történet segítségével a videojátékok vonzereje soha nem halványul meg.
            Hihetetlen mennyiségű cím van odakint, de néhány közülük a többi felett áll.
            Igyekeztünk összegyűjteni a különböző korszakok kiemelkedő alkotásait a gamerek világában. </p>

        <img src="img/evolution.png" alt="Evolúció" width="1000" height="800">

    </main>
</body>
<footer>

</footer>
</html>