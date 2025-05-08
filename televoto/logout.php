<?php

    if(!isset($_SESSION)) {
        session_start();
    }
    $_SESSION["utenteCorrente"] = null;
    session_destroy();
    header("location: index.php?messaggio=Logout effettuato con successo");
    exit;
    
?>