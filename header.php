<?php

    //pagina header da includere con la require che contiene elementi che si ripeterebbero
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_GET["messaggio"])) {
        echo $_GET["messaggio"];
    }

    echo '<a href="home.php">Torna alla home</a><br>';
    echo '<a href="logoutTemp.php">Effettua il logout</a><br>';
    
?>