<?php
 // session_start();
  session_unset();          //ures lesz a $_SESSION tomb
  session_destroy();        //munkamenet törlése

  header("Location: bejelentkezes.php");    // átirányít a bejelentkezes.phpra
?>
