<?php

require_once("conn.php");
if (!isset($_SESSION)) {
    # code...
    session_start();
}
if (isset($_SESSION["loggato"])) {
    # code...
    header("location: home.php?messaggio=Sei già loggato");
    exit();
}
//TODO:controlli
$user = $_GET["username"];
$sql = "SELECT * FROM `utenti` WHERE username = '$user'";
//echo $sql;
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
if ($result->num_rows == 0) {
    # code...
    echo "username o pass errati";
} else if ($result->num_rows == 1) {

    $utente = new Utente($user, $row["privilegio"]);
    $_SESSION["loggato"] = true;
    $_SESSION["user"]= $utente;

    header("location: home.php");
    exit();
} else {
    echo "Non fare il furbetto!";
}
