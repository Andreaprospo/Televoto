<?php
require_once("conn.php");
    if (!isset($_SESSION)) {
        # code...
        session_start();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        print_r($_SESSION);
        if ($_SESSION["privilegio"] == "P" || $_SESSION["privilegio"] == "P+A") {
            echo '<a href="visualizzaStorico.php">Visualizzazione storico </a>  ';
            echo '<a href="collegaTerzi.php">collegamento terzi</a>';
        }
        else if ($_SESSION["privilegio"] == "A" || $_SESSION["privilegio"] == "P+A") {
            echo '<a href="collegaTerzi.php">collegamento terzi</a>';
            echo '<a href="creazioneVoti.php">creazione Votazione</a>';
        }
        echo '<a href="associazione.php">Associazione proprio telecomando</a>  ';
    ?>
    <a href="logoutTEMP.php">logout</a>
</body>
</html>
