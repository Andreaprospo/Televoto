<?php
if(!isset($_SESSION)){
    session_start();
}

require_once("Classi/Session.php");

if(Session::getInstance()->getUtenteCorrente()===null){
    header("location: index.php?messaggio=devi fare il login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Benvenuto</h1>

    <?php

    //controllo se l'utente è admin o privilegiato

    $isAdmin = true;
    $isPrivilegiato = true;
    
    if($_SESSION["utenteCorrente"]->getPrivilegio()==="A+P"){
        $isAdmin = true;
        $isPrivilegiato = true;
    }
    if($_SESSION["utenteCorrente"]->getPrivilegio()==="A"){
        $isAdmin = true;
    }
    if($_SESSION["utenteCorrente"]->getPrivilegio()==="P"){
        $isPrivilegiato = true;
    }
    ?>


    <?php

    echo "<a href='votazione.php'>Vai a pag Votazione</a>";
    echo "<br><br>";

    echo "<a href='collegamento.php'>Collega Telecomando</a>";
    echo "<br><br>";


    if($isAdmin){
        echo "<a href='admin.php'>Vai a pag Admin</a>";
        echo "<br><br>";
    }
    if($isPrivilegiato){
        echo "<a href='privilegiato.php'>Vai a pag Privilegiato</a>";
        echo "<br><br>";
    }
    
    
    ?>

    <a href="logout.php">fai logout</a>


</body>
</html>