<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION["loggato"])) {
        header("location: index.php?messaggio=Devi essere loggato");
        exit;
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
        require_once("header.php");
    ?>

    ciao    

</body>
</html>