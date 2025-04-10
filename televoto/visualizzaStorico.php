<?php
require_once("Classi/Utente.php");
require_once("Classi/GestoreDatabase.php");
if(!isset($_SESSION)){
    session_start();
}


if(!isset($_SESSION["utenteCorrente"])){
    header("location: login.php?error=devi fare il login");
}
if($_SESSION["utenteCorrente"]->getPrivilegio()!=="P" && $_SESSION["utenteCorrente"]->getPrivilegio()!=="P+A"){
    header("location: home.php?error=non hai i privilegi per accedere a questa pagina");
}
if(isset($_GET["messaggio"])){
    echo "<h1>".$_GET['messaggio']."</h1>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privilegiato</title>
</head>

<body>
    <h1>Privilegiato</h1>

    <?php

    $votazioni = GestoreDatabase::getInstance()->getAllVotazioniFromCollegio(1);

    echo '<table border="1">';
    echo '<tr><th>ID Votazione</th><th>Domanda</th><th>risposte</th><th>numero Voti</th></tr>';

    foreach ($votazioni as $votazione) {
        echo '<tr>';
        echo '<td>' . $votazione->getIdVotazione() . '</td>';
        echo '<td><a href="dettagliVotazione.php?id=' . $votazione->getIdVotazione() . '">' . $votazione->getDomanda() . '</a></td>';

        $risposte = GestoreDatabase::getInstance()->getRisposteForDomanda($votazione->getIdVotazione());

        echo '<td>';
        foreach ($risposte as $risposta) {
            echo '<div>' . $risposta["risposta"] . '</div>';
        }
        echo '</td>';
        echo '<td>';
        foreach ($risposte as $risposta) {
            echo '<div>' . $risposta["numeroVoti"] . '</div>';
        }
        echo '</td>';

        echo '</tr>';
    }

    echo '</table>';
    ?>

</body>

</html>