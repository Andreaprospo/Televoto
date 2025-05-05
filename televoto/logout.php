<?php

    if(!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION["utenteCorrente"]) || $_SESSION["utenteCorrente"] == null) {
        header("Location: login.php");
        exit;
    }

    $utenteCorrente = $_SESSION["utenteCorrente"];
    
?>