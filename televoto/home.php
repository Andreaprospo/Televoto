<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            require_once("Classi/GestoreDatabase.php");
            require_once("Classi/Utente.php");
            require_once("Classi/Votazione.php");

            if(!isset($_SESSION)) {
                session_start();
            }
            print_r($_SESSION);


            ?>

            <button><a href="paginaCreazioneVotazione.php">Votazione</a></button>

    </body>
</html>