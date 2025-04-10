<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once("Classi/Session.php");

if (Session::getInstance()->getUtenteCorrente() === null) {
    header("location: index.php?messaggio=devi fare il login");
}
if (Session::getInstance()->getUtenteCorrente()->getPrivilegio() !== "A" && Session::getInstance()->getUtenteCorrente()->getPrivilegio() !== "A+P") {
    header("location: home.php?messaggio=non hai i privilegi per accedere a questa pagina");
}



require_once("Classi/GestoreDatabase.php");
require_once("Classi/Utente.php");
require_once("Classi/Votazione.php");
require_once("Classi/Session.php");

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
    header("location:paginaCreazioneVotazione.php?error=risposteInsufficienti");
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
$sessione = Session::getInstance();
$sessione->setVotazioneCorrente(Votazione::parse($conn->getVotazione($idVotazione)));
echo "Sessione creata";
echo $sessione->getVotazioneCorrente()->getIdVotazione();
print_r($sessione->getVotazioneCorrente());
foreach ($risposte as $risposta) {
    $conn->createRiposta($risposta, $idVotazione);
}
