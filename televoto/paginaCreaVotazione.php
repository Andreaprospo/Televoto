<?php
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="GestioneCreaVotazione.php" method="get">
     <?
        //da dinamicizzare
     ?>

    Domanda: <input type="text" name="Domanda" id="">
    Risposta 1: <input type="text" name="Risposta1" id="">
    Risposta 2: <input type="text" name="Risposta2" id="">
    Risposta 3: <input type="text" name="Risposta3" id="">
    Risposta 4: <input type="text" name="Risposta4" id="">
    <input type="submit" value="">
    </form>
</body>

</html>