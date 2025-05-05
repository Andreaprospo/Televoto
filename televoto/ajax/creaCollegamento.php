<?php

    require_once("../Classi/GestoreDatabase.php");
    require_once("../Classi/Utente.php");
    require_once("../Classi/Votazione.php");


    $vettoreRitorno = null;
    if (!isset($_SESSION)) {
        session_start();
    }
    
    if(!isset($_SESSION["utenteCorrente"]) || empty($_SESSION["utenteCorrente"]))
    {
        $vettoreRitorno["status"] = "ERR";
        $vettoreRitorno["msg"] = "Utente non loggato";
        print(json_encode($vettoreRitorno));
        return;
    }

    if(!isset($_GET["idTelecomando"]) || empty($_GET["idTelecomando"]))
    {
        $vettoreRitorno["status"] = "ERR";
        $vettoreRitorno["msg"] = "Parametro idTelecomando non inserito";
        print(json_encode($vettoreRitorno));
        return;
    }

    $idTelecomando = $_GET["idTelecomando"];
    $idVotante = $_SESSION["utenteCorrente"]->getId();
    $gestoreDatabase = GestoreDatabase::getInstance();

    $result = $gestoreDatabase->creaCollegamento($idTelecomando, $idVotante);
    if($result)
    {
        $vettoreRitorno["status"] = "OK";
        $vettoreRitorno["msg"] = "Collegamento creato con successo!";
    }
    else
    {
        $vettoreRitorno["status"] = "ERR";
        $vettoreRitorno["msg"] = "Collegamento non creato!";
    }
    print(json_encode($vettoreRitorno));
    return;
?>