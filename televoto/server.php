<?php
    require_once("Classi/GestoreDatabase.php");
    require_once("Classi/Utente.php");
    require_once("Classi/Votazione.php");
    
    if(!isset($_SESSION))
        session_start();

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['button'])) {
            $button = intval($_GET['button']);
            // Azione da fare con il pulsante, ad esempio log
            $conn = GestoreDatabase::getInstance();
            $votazioneCorrente = $_SESSION["votazioneCorrente"];
            $conn->addVoto(4, $votazioneCorrente->getIdVotazione());
            $conn->changeNumVoti($votazioneCorrente->getIdVotazione(),$button);
        } else {
            echo "Parametro 'button' mancante";
        }
    } else {
        echo "Metodo non supportato";
    }
?>
