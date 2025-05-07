<?php

    require_once("../Classi/GestoreDatabase.php");
    require_once("../Classi/Utente.php");
    require_once("../Classi/Votazione.php");

    if (!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION["utenteCorrente"]))
    {
        header("location: login.php?error=devi fare il login");
        exit;
    }

    if($_SESSION["utenteCorrente"]->getPrivilegio()!=="A" && $_SESSION["utenteCorrente"]->getPrivilegio()!=="P+A")
    {
        header("location: home.php?error=non hai i privilegi per accedere a questa pagina");
        exit;
    }

    $gestoreDatabase = GestoreDatabase::getInstance();
    $utenteCorrente = $_SESSION["utenteCorrente"];
    $result = $gestoreDatabase->createNewCollegio($utenteCorrente->getId());

    if($result)
    {
        $vettoreRitorno["status"] = "OK";
        $vettoreRitorno["msg"] = "Collegio creato con successo!";
    }
    else
    {
        $vettoreRitorno["status"] = "ERR";
        $vettoreRitorno["msg"] = "Collegio non creato!";
    }
    print(json_encode($vettoreRitorno));
    return;

?>