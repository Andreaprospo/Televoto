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
    <form action="gestisciCreaCollegio.php" method="get">
        Inserire la data in cui si vuole fare il collegio:
        <input type="date" name="data" id="">
        <input type="submit" value="">
    </form>
</body>
</html>