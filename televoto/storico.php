<?php
require_once("Classi/Utente.php");
require_once("Classi/GestoreDatabase.php");
require_once("Classi/Votazione.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["utenteCorrente"])) {
    header("location: login.php?messaggio=devi fare il login");
    exit;
}

$privilegio = $_SESSION["utenteCorrente"]->getPrivilegio();
if ($privilegio !== "P" && $privilegio !== "P+A") {
    header("location: home.php?messaggio=non hai i privilegi per accedere a questa pagina");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Area Privilegiata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/styleStorico.css">
    <link rel="icon" type="image/png" href="CSS/icona.png">

</head>

<body>

    <h1>Area Privilegiata - Votazioni</h1>

    <!-- Link "Torna alla home" -->
    <a href="home.php" id="home">Torna alla home</a>

    <?php
    if (isset($_GET["messaggio"])) {
        echo '<div class="message">' . htmlspecialchars($_GET["messaggio"]) . '</div>';
    }

    // Recupera tutti i collegi
    $gestoreDatabase = GestoreDatabase::getInstance();
    $collegi = $gestoreDatabase->getAllCollegi();  // Assumendo che la funzione getAllCollegi restituisca l'array come sopra

    if ($collegi && count($collegi) > 0) {
        // Ciclo per ogni collegio
        foreach ($collegi as $collegio) {
            echo '<h2>ID collegio: ' . htmlspecialchars($collegio['IDcollegio']) . ' ---- Data: ' . htmlspecialchars($collegio['data']) . '</h2>';

            // Recupera tutte le votazioni per il collegio corrente
            $votazioni = $gestoreDatabase->getAllVotazioniFromCollegio($collegio['IDcollegio']);

            if ($votazioni && count($votazioni) > 0) {
                echo '<table>';
                echo '<tr><th>ID Votazione</th><th>Domanda</th><th>Risposte</th><th>Numero Voti</th></tr>';

                foreach ($votazioni as $votazione) {
                    $idVotazione = $votazione->getIdVotazione();
                    $domanda = htmlspecialchars($votazione->getDomanda());

                    echo '<tr>';
                    echo '<td>' . $idVotazione . '</td>';
                    echo '<td><a href="dettagliVotazione.php?id=' . $idVotazione . '">' . $domanda . '</a></td>';

                    $risposte = $gestoreDatabase->getRisposteForDomanda($idVotazione);

                    echo '<td>';
                    foreach ($risposte as $risposta) {
                        echo '<div>' . htmlspecialchars($risposta["risposta"]) . '</div>';
                    }
                    echo '</td>';

                    echo '<td>';
                    foreach ($risposte as $risposta) {
                        echo '<div>' . (int)$risposta["numeroVoti"] . '</div>';
                    }
                    echo '</td>';

                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo '<p>Nessuna votazione disponibile per questo collegio.</p>';
            }
        }
    } else {
        echo '<p class="message">Nessun collegio disponibile.</p>';
    }
    ?>

</body>

</html>