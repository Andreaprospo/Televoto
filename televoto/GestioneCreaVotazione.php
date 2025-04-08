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

if (empty($_GET["Domanda"])&& empty($_GET["Risposta1"]) && empty($_GET["Risposta2"]) && empty($_GET["Risposta3"]) && empty($_GET["Risposta4"]) ) {
    header("location: paginaCreaVotazione.php?=Una delle risposte è vuote");
    exit;
}
//dinamicizzarla
if (empty($_GET["Risposta1"]) && empty($_GET["Risposta2"]) && empty($_GET["Risposta3"]) && empty($_GET["Risposta4"]) ) {
    # code...
    header("location: paginaCreaVotazione.php?=Una delle risposte è vuote");
    exit;
}
$_SESSION["Risposta1"] = $_GET["Risposta1"];
$_SESSION["Risposta2"] = $_GET["Risposta2"];
$_SESSION["Risposta3"] = $_GET["Risposta3"];
$_SESSION["Risposta4"] = $_GET["Risposta4"];
$q = "SELECT `IDcollegio` FROM `collegi` ORDER BY `IDcollegio` DESC LIMIT 1;";
$result2 = $mysqli->query($sql);
$rows = $result->fetch->assoc();
if($result2->num_rows > 1)
{
    echo "errore!!!!!!!!!!!!!!!!!!!!";
}

$sql = "INSERT INTO `votazioni`(`IDvotazione`, `domanda`, `IDcollegio`) VALUES (NULL,'".$_GET["Domanda"]."',".$rows["IDcollegio"].");";
$result = $mysqli->query($sql);
?>