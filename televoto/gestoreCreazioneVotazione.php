<?php
    require_once("Classi/GestoreDatabase.php");
    require_once("Classi/Utente.php");
    require_once("Classi/Votazione.php");

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

    if (!isset($_GET["domanda"]) || empty($_GET["domanda"])) {
        echo "Errore: uno o più campi sono vuoti.";
        exit;
    }
    
    $gestoreDatabase = GestoreDatabase::getInstance();
    $domanda = $_GET["domanda"];
    $idCollegio = $gestoreDatabase->getLastCollegio();
    $risposte = [];

    for ($i = 0; $i <= 4; $i++) {
        if (!isset($_GET["risposta" . $i]) || empty($_GET["risposta" . $i])) {
            continue;
        }
        $risposte[] = $_GET["risposta" . $i];
    }

    if (sizeof($risposte) < 2) {
        header("location:creazioneVotazione.php?error=risposteInsufficienti");
        exit;
    }
    else
    {
        $idVotazione = $gestoreDatabase->createVotazione($domanda, $idCollegio);
        $_SESSION["votazioneCorrente"] = $gestoreDatabase->getVotazione($idVotazione);
        foreach ($risposte as $risposta) {
            $gestoreDatabase->createRisposta($risposta, $idVotazione);
        }
        header("location: home.php?messaggio=Votazione creata con successo");
        exit;
    }

?>
