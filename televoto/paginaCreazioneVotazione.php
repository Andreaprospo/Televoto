<?php
if(!isset($_SESSION)){
    session_start();
}

require_once("Classi/Session.php");

if(Session::getInstance()->getUtenteCorrente()===null){
    header("location: index.php?messaggio=devi fare il login");
}
if(Session::getInstance()->getUtenteCorrente()->getPrivilegio() !=="P" && Session::getInstance()->getUtenteCorrente()->getPrivilegio()!=="A+P"){
    header("location: home.php?messaggio=non hai i privilegi per accedere a questa pagina");
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
        <form action="gestoreCreazioneVotazione.php" method="POST">
            <label for="domanda">Domanda:</label><br>
            <input type="text" id="domanda" name="domanda"><br>
            <label for="risposta1">Risposta1: </label>
            <input type="text" id="risposta1" name="risposta1"><br>
            <label for="risposta2">Risposta2: </label>
            <input type="text" id="risposta2" name="risposta2"><br>
            <label for="risposta3">Risposta3: </label>
            <input type="text" id="risposta3" name="risposta3"><br>
            <label for="risposta4">Risposta4: </label>
            <input type="text" id="risposta4" name="risposta4"><br>
            <button>Crea domanda</button>
        </form>
    </body>
</html>