<?php

    require_once("Classi/GestoreDatabase.php");
    require_once("Classi/Utente.php");
    require_once("Classi/Votazione.php");
    require_once("Classi/Session.php");
    


    if(!isset($_POST["username"], $_POST["password"]) || empty($_POST["username"]) || empty($_POST["password"])) {
        // Se non sono stati passati i dati, reindirizza alla pagina di login
        header("Location:index.php?messaggio=Login non valido");
        exit();
    }

    if(!isset($_SESSION)) {
        session_start();
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    // URL della pagina server con parametri GET
    $url = "https://agora.ismonnet.it/project/checkCredential.php?username=" . urlencode($username) . "&password=" . urlencode($password);

    // Inizializza cURL
    $ch = curl_init();

    // Imposta le opzioni cURL per la richiesta GET
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Per ottenere la risposta come stringa

    // Esegui la richiesta
    $response = curl_exec($ch);

    // Controlla se ci sono errori nella richiesta cURL
    if (curl_errno($ch)) {
        echo "Errore cURL: " . curl_error($ch);
    } else {
        // Decodifica la risposta JSON
        $decodedResponse = json_decode($response, true);

        // Controlla se il JSON è valido
        if (json_last_error() === JSON_ERROR_NONE) {
            // Gestisce il successo o l'errore della risposta
            if (isset($decodedResponse['status']) && $decodedResponse['status'] === 'OK') {

                $gestoreDatabase = GestoreDatabase::getInstance();
                $sessione = Session::getInstance();
                $sessione->setUtenteCorrente($gestoreDatabase->getUtente($username));
                header("Location:home.php?messaggio=Login riuscito");
            } else {
                header("location:index.php?messaggio=" . ($decodedResponse['message'] ?? "Login fallito"));
                echo "Errore: " . ($decodedResponse['message'] ?? "Risposta sconosciuta");
            }
        } else {
            echo "Errore nella decodifica della risposta JSON!";
        }
    }

?>