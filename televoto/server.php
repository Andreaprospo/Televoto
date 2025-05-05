<?php
require_once("Classi/GestoreDatabase.php");
require_once("Classi/Utente.php");
require_once("Classi/Votazione.php");

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['button'], $_GET['mac']) && !empty($_GET['button']) && !empty($_GET['mac'])) {

        $button = intval($_GET['button']);
        $mac = $_GET['mac'];
        $conn = GestoreDatabase::getInstance();

        // Trova idVotante dal MAC
        $idVotante = $conn->getIdVotanteByMac($mac);
        if ($idVotante != null) {
            $conn->addVoto($idVotante);
            $conn->changeNumVoti($button);
            echo "✅ Voto registrato con successo per ID $idVotante (MAC: $mac), pulsante: $button";
        } else {
            echo "❌ MAC address non riconosciuto: $mac";
        }

    } else {
        echo "❌ Parametri 'button' o 'mac' mancanti";
    }
} else {
    echo "❌ Metodo non supportato";
}
?>
