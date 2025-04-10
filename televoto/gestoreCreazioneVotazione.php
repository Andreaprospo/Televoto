<?php
require_once("Classi/GestoreDatabase.php");
require_once("Classi/Utente.php");
require_once("Classi/Votazione.php");
if (!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["utenteCorrente"])){
    header("location: login.php?error=devi fare il login");
}
if($_SESSION["utenteCorrente"]->getPrivilegio()!=="A" && $_SESSION["utenteCorrente"]->getPrivilegio()!=="P+A"){
    header("location: home.php?error=non hai i privilegi per accedere a questa pagina");
}


if (!isset($_POST["domanda"]) || empty($_POST["domanda"])) {
    echo "Errore: uno o più campi sono vuoti.";
    exit;
}

$risposte = [];
for ($i = 0; $i <= 4; $i++) {
    if (!isset($_POST["risposta" . $i]) || empty($_POST["risposta" . $i])) {
        continue;
    }
    $risposte[] = $_POST["risposta" . $i];
}


if (sizeof($risposte) < 2) {
    header("location:creazioneVotazione.php?error=risposteInsufficienti");
    exit;
}

if (!isset($_SESSION)) {
    session_start();
}

$conn = GestoreDatabase::getInstance();

$domanda = $_POST["domanda"];
//$collegioCorrente = $_SESSION["collegioCorrente"];
$idCollegio = 1;

$idVotazione = $conn->createVotazione($domanda, $idCollegio);

$_SESSION["votazioneCorrente"] = $conn->getVotazione($idVotazione);

header("location: home.php?messaggio=Votazione creata con successo");
