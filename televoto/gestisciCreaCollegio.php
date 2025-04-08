<?php
require_once("conn.php");
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION["loggato"] != true) {
    header("location: index.php?=Utente non autenticato");
    exit;
}

if ($_SESSION["privilegio"] != "A" || $_SESSION["privilegio"] != "P+A") {
    header("location: index.php?=Privilegi non conformi");
    exit;
}
$sql = "INSERT INTO `collegi`(`IDcollegio`, `data`, `IDutenteAdmin`) 
VALUES 
(NULL, '".$_GET["data"]."', (SELECT `IDutenteAdmin` FROM `utenti` WHERE `nome_utente` = '".$_SESSION["username"]."'));";
$result = $mysqli->query($sql);

if ($mysqli->query($sql) === TRUE) {
    // Se la query ha successo, reindirizza a paginaCreaVotazione.php
    header("location: paginaCreaVotazione.php");
    exit;
} else {
    // Se la query fallisce, reindirizza a creaCollegio.php con un messaggio di errore
    header("location: creaCollegio.php?error=Errore durante la creazione del collegio");
    exit;
}

?>