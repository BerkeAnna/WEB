<?php
include_once "felhasznalok.php";
include_once "függvények.php";
$usernamefoglalt = false;
$uzenet="";
$datas=loadUsers("users.txt");

if (isset($_SESSION["user"])) {
    header("Location: Profil.php");
}


if (isset($_POST["reg"])) {
    if (!isset($_POST["username"]) || trim($_POST["username"]) === "") //ellenorzi ures-e, a trim eltávolítja a beírt érték elejéről és a végéről a fölösleges whitespace karakterket
    die("<strong>HIBA:</strong>Kötelező felhasználónevet megadni!<a href='Űrlap.php'>Vissza a regisztrációhoz</a>");


    if (!isset($_POST["password"]) || trim($_POST["password"]) === "" || !isset($_POST["password2"]) || trim($_POST["password2"]) === "")
    die("<strong>HIBA:</strong>A jelszó és az ellenőrző jelszó megadása kötelező!!<a href='Űrlap.php'>Vissza a regisztrációhoz</a>");


    if (!isset($_POST["birth_date"]) || trim($_POST["birth_date"]) === "")
    die("<strong>HIBA:</strong>Az születési dátum megadása kötelező!<a href='Űrlap.php'>Vissza a regisztrációhoz</a>");


   /* if (!isset($_POST["phone_number"]) || trim($_POST["phone_number"]) === "")
    die("<strong>HIBA:</strong>A telefonszám megadása kötelező!<a href='Űrlap.php'>Vissza a regisztrációhoz</a>");
*/
    if (strlen($_POST["username"])<5) {
        die("<strong>HIBA:</strong>A felhasználónévnek legalább 5 karakter hosszúnak kell lennie<a href='Űrlap.php'>Vissza a regisztrációhoz</a>");
    }
    if (strlen($_POST["password"])<8){
        die("<strong>HIBA:</strong>A jelszónak legalábbb 8 karakter hosszúnak kell lennie! <a href='Űrlap.php'>Vissza a regisztrációhoz</a>");
    }
    if ($_POST["password"] !== $_POST["password2"]){
        die("<strong>HIBA:</strong>A két jelszónak meg kell egyeznie! <a href='Űrlap.php'>Vissza a regisztrációhoz</a>");
    }
    if (strlen($_POST["telefonszam"])<11  || strlen($_POST["telefonszam"])>11) {
        die("<strong>HIBA:</strong>A telefonszámnak 11 karakter hosszúnak kell lennie<a href='Űrlap.php'>Vissza a regisztrációhoz</a>");
    }
    //ciklussal vegigmegy, ha egyenlo a megadott nevvel igazra allitja, majd die-t kap
    for ($i=0; $i<count($_SESSION["regFelhasznalok"]);$i++){
        if ($_SESSION["regFelhasznalok"][$i]-> getUsername() == $_POST["username"]){
            $usernamefoglalt = true;
        }
    }
    if ($usernamefoglalt){
        die("<strong>HIBA:</strong>A megadott felhasználónév már foglalt! <a href='Űrlap.php'>Vissza a regisztrációhoz</a>");

    }else{
        if (isset($_FILES["kep"])){
            $kiterjesztesek = ["jpg", "png"];
            $kepkiterjsztes = strtolower(pathinfo($_FILES["kep"]["name"],PATHINFO_EXTENSION));
            if(in_array($kepkiterjsztes,$kiterjesztesek)){
                if ($_FILES["kep"]["error"]===0){
                    if ($_FILES["kep"]["size"] <= 31457280){
                        $cel = "img/".$_POST["username"].".".$kepkiterjsztes;
                    }if(move_uploaded_file($_FILES["kep"]["tmp_name"],$cel)){
                        $uzenet.="Sikeres fájlfeltöltés";
                    }else{
                        die("<strong>HIBA:</strong>A kép átmozgatása sikertelen! <a href='Űrlap.php'>Vissza a regisztrációhoz</a>");

                    }
                }else{
                    die("<strong>HIBA:</strong>Nagyok a méreteid! <a href='Űrlap.php'>Vissza a regisztrációhoz</a>");

                }
            }else{
                die("<strong>HIBA:</strong>A fájlfeltöltés során hiba lépett fel, nem sikerült a fájlfeltöltés! <a href='Űrlap.php'>Vissza a regisztrációhoz</a>");

            }
        }else{
            die("<strong>HIBA:</strong>Nem megfelelő a kiterjesztés! <a href='Űrlap.php'>Vissza a regisztrációhoz</a>");

        }
    }
    $uj = new User($_POST["username"],$_POST["password"],$_POST["email"],$_POST["telefonszam"],$_POST["birth_date"],$_POST["username"].".".$kepkiterjsztes);
   array_push($_SESSION["regFelhasznalok"],$uj); //beszurja a uj-at a SESSION["regFelhasznalok"] vegere
    $uj->kiirfajlba(); //kiirfajlba fuggveny (a User.phpbol)
    $uzenet.="Sikeres regisztráció";
    header("Location: bejelentkezes.php"); //atiranyit a bejelentkezes.phpra

    $uj->udvozol();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Űrlap</title>
    <link rel="stylesheet" href="style.css"/>


</head>
<body id="border">

<header>
    <h1>Regisztráció</h1>
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
                    <a href="Űrlap.php" class="aktiv">Űrlap</a>
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
    <?php
    echo "<p>".$uzenet."</p>"
    ?>
<form method="POST" action="Űrlap.php" enctype="multipart/form-data">


   <div class="kozepre">
       <fieldset>

           <div class=kotelezo>
        <label for=username>Felhasználónév: </label>
        </div>
        <input type="text" id="username" name="username" maxlength="30" placeholder="Felhasználónév..." required /> <br/>

            <div class=kotelezo>
        <label for=password>Jelszó: </label>
        </div>
        <input type="password" id="password" name="password"  minlength="6" maxlength="30"  placeholder="Jelszó..." required /> <br/>

            <div class=kotelezo>
        <label for=password2>Jelszó újra: </label>
        </div>
        <input type="password" id="password2" name="password2"  minlength="6" maxlength="30"  placeholder="Jelszó újra..." required /> <br/>

            <div class=kotelezo>
        <label for=email>Email cím: </label>
        </div>
        <input type="email" id="email" name="email" placeholder="pl.: valaki@gmail.com" required /> <br/>

            <div class=kotelezo>
        <label for=telefonszam>Telefonszám: </label>
        </div>
        <input type="tel" id="telefonszam" name="telefonszam" placeholder="pl.: 06201234567" required /> <br/>

            <div class=kotelezo>
        <label for=birthdate>Születési dátum: </label>
        </div>
        <input type="date" id="birthdate" name="birth date"  required /> <br/>

           <div class="kotelezo">
               <label for="kep">Profilkép</label>
               <br>
        <input required type="file" id="kep" name="kep" accept="image/*">
           </div>
</fieldset>


    <div class="dolt">
        <p>Melyiket ismered az 1990-1999 között népszerű játékok közül?</p>
    </div>
        <label for="choose1">Half-Life</label>
        <input type="checkbox" id="choose1" name="choose1" value="first"/>

        <label for="choose2">Final Fantasy VII. </label>
        <input type="checkbox" id="choose2" name="choose2" value="second"/>

        <label for="choose3">DOOM/DOOM II: Hell on Earth</label>
        <input type="checkbox" id="choose3" name="choose3" value="third"/>

        <label for="choose4">Metal Gear Solid </label>
        <input type="checkbox" id="choose4" name="choose4" value="fourth"/>

        <label for="choose5">Super Metroid </label>
        <input type="checkbox" id="choose5" name="choose5" value="fifth"/>

    <div class="dolt">
        <p>Melyiket ismered az 2000-2009 között népszerű játékok közül?</p>
        </div>
        <label for="choose6">Portal</label>
        <input type="checkbox" id="choose6" name="choose6" value="sixth"/>

        <label for="choose7">Bioshock</label>
        <input type="checkbox" id="choose7" name="choose7" value="seventh"/>

        <label for="choose8">Fallout 3</label>
        <input type="checkbox" id="choose8" name="choose8" value="eighth"/>

        <label for="choose9">Shadow of the Colossus</label>
        <input type="checkbox" id="choose9" name="choose9" value="ninth"/>

        <label for="choose10">Resident Evil 4 </label>
        <input type="checkbox" id="choose10" name="choose10" value="tenth"/>

    <div class="dolt">
        <p>Melyiket ismered az 2010-2019 között népszerű játékok közül?</p>
        </div>
        <label for="choose11">Minecraft</label>
        <input type="checkbox" id="choose11" name="choose11" value="eleventh"/>

        <label for="choose12">The legend of Zelda: Breath of the wild</label>
        <input type="checkbox" id="choose12" name="choose12" value="twelfth"/>

        <label for="choose13">Spelunky</label>
        <input type="checkbox" id="choose13" name="choose13" value="thirteenth"/>

        <label for="choose14">Kentacky Route Zero</label>
        <input type="checkbox" id="choose14" name="choose14" value="fourteenth"/>

        <label for="choose15">Pokémon Go</label>
        <input type="checkbox" id="choose15" name="choose15" value="fifteenth"/>

        <br/>

        <input type="submit" name= "reg" value="Regisztráció">  <br/>
        <input  type="reset" name = "adatok törlése" value="Adatok törlése">
   </div>

    <div class="kotelezo">
        <div class="jobbra" ><p>A pirossal jelölt mezők kitöltése kötelező</p>
        </div>
        </div>

</form>

</main>

</body>
</html>