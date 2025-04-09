<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    if ($_SESSION["loggato"] != true) {
        header("location: index.php?=Utente non autenticato");
        exit;
    }

    //connessione database per fare le rischieste sulle credenziali

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="paginaVotante">
        <button>Torna nella pagina votante</button>
    </form>

    <!-- Form per inserire le credenziali dell'utente e il codice del telecomando -->
    
</body>
</html>