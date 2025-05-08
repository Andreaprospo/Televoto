<?php
require_once("Classi/GestoreDatabase.php");
require_once("Classi/Utente.php");
require_once("Classi/Votazione.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["utenteCorrente"])) {
    header("location: login.php?messaggio=Errore: login non effettuato");
    exit;
}

if ($_SESSION["utenteCorrente"]->getPrivilegio() !== "P" && $_SESSION["utenteCorrente"]->getPrivilegio() !== "P+A") {
    header("location: home.php?messaggio=Privilegi non sufficienti per accedere a questa pagina");
    exit;
}

$gestoreDatabase = GestoreDatabase::getInstance();

if (isset($_GET["id"])) {
    $idVotazione = $_GET["id"];
} else {
    $idVotazione = $gestoreDatabase->getLastIdVotazione();
}

if ($idVotazione == null) {
    ?>
    <!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nessuna votazione</title>
        <link rel="stylesheet" href="CSS/styleDettagliVotazione.css">
        <link rel="icon" type="image/png" href="CSS/icona.png">
    </head>
    <body>
        <div class="errore-box">
            <h2>⚠️ Nessuna votazione disponibile</h2>
            <p>Non è stata trovata alcuna votazione registrata nel sistema.</p>
            <p><a href="creazioneVotazione.php" class="crea-link">Crea una nuova votazione</a></p>
            <a href="home.php" class="link-secondary">🔙 Torna alla home</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Se tutto va bene, mostra i dettagli
$votazione = $gestoreDatabase->getVotazione($idVotazione);
$risposte = $gestoreDatabase->getRisposteForDomanda($idVotazione);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleDettagliVotazione.css">
    <title>Dettagli Votazione</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Dettagli della Votazione</h1>

    <div class="nav-links">
        <a href="storico.php">↩ Torna allo storico</a>
        <a href="home.php">🏠 Torna alla home</a>
    </div>

    <div class="info-container">
        <h2>Informazioni</h2>
        <table>
            <tr>
                <th>ID Votazione</th>
                <th>Domanda</th>
                <th>Risposte</th>
                <th>Numero di Voti</th>
            </tr>
            <tr>
                <td><?= $votazione->getIdVotazione(); ?></td>
                <td><?= htmlspecialchars($votazione->getDomanda()); ?></td>
                <td>
                    <ul>
                        <?php foreach ($risposte as $risposta): ?>
                            <li><?= htmlspecialchars($risposta["risposta"]); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td>
                    <ul>
                        <?php foreach ($risposte as $risposta): ?>
                            <li><?= (int)$risposta["numeroVoti"]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <h2>Grafici dei Risultati</h2>
    <div class="grafici-container">
        <div class="grafico-box">
            <canvas id="graficoBarre"></canvas>
        </div>
        <div class="grafico-box">
            <canvas id="graficoTorta"></canvas>
        </div>
    </div>

    <script>
        const etichette = <?= json_encode(array_column($risposte, "risposta")); ?>;
        const voti = <?= json_encode(array_map('intval', array_column($risposte, "numeroVoti"))); ?>;
        const titolo = "<?= addslashes($votazione->getDomanda()); ?>";

        const colori = [
            'rgba(59, 130, 246, 0.7)',   // Blu
            'rgba(16, 185, 129, 0.7)',   // Verde
            'rgba(239, 68, 68, 0.7)',    // Rosso
            'rgba(245, 158, 11, 0.7)',   // Arancione
            'rgba(139, 92, 246, 0.7)',   // Viola
            'rgba(236, 72, 153, 0.7)',   // Rosa
            'rgba(20, 184, 166, 0.7)',   // Turchese
            'rgba(124, 58, 237, 0.7)'    // Indaco
        ];

        const borderColori = colori.map(color => color.replace('0.7', '1'));

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                title: { 
                    display: true, 
                    text: titolo,
                    font: {
                        size: 16,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                }
            }
        };

        new Chart(document.getElementById('graficoBarre'), {
            type: 'bar',
            data: {
                labels: etichette,
                datasets: [{
                    label: 'Numero di voti',
                    data: voti,
                    backgroundColor: colori,
                    borderColor: borderColori,
                    borderWidth: 1
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('graficoTorta'), {
            type: 'pie',
            data: {
                labels: etichette,
                datasets: [{
                    label: 'Numero di voti',
                    data: voti,
                    backgroundColor: colori,
                    borderColor: borderColori,
                    borderWidth: 1
                }]
            },
            options: commonOptions
        });
    </script>
</body>
</html>