<?php
if(!isset($_SESSION))
{
    session_start();
}

if($_SESSION["loggato"] != true)
{
    header("location: index.php?=Utente non autenticato");
    exit;
}

if($_SESSION["privilegio"] != "P" || $_SESSION["privilegio"] != "P+A" )
{
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
    
</body>
</html>