<?php
if (!isset($_GET["id"])) {
    header("location: visualizzaStorico.php?messaggio=cliccare sul nome di una votazione per visualizzarne i dettagli");
    exit();
}

if(!isset($_SESSION)){
    session_start();
}

require_once("Classi/Session.php");

if(Session::getInstance()->getUtenteCorrente()===null){
    header("location: index.php?error=devi fare il login");
}
if(Session::getInstance()->getUtenteCorrente()->getPrivilegio() !=="P" && Session::getInstance()->getUtenteCorrente()->getPrivilegio()!=="A+P"){
    header("location: home.php?error=non hai i privilegi per accedere a questa pagina");
}

require_once("Classi/GestoreDatabase.php");
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Votazione</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .grafici-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            margin: 30px 0;
        }

        canvas {
            max-width: 400px;
            max-height: 400px;
        }
    </style>
</head>

<body>
    <h1>Dettagli della Votazione</h1>

    <a href="visualizzaStorico.php">torna allo storico</a>

    <?php
    $votazione = GestoreDatabase::getInstance()->getVotazione($_GET["id"]);
    $risposte = GestoreDatabase::getInstance()->getRisposteForDomanda($votazione->getIdVotazione());

    echo '<h2>Informazioni</h2>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr>';
    echo '<th>ID Votazione</th>';
    echo '<th>Domanda</th>';
    echo '<th>Risposte</th>';
    echo '<th>Numero di Voti</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $votazione->getIdVotazione() . '</td>';
    echo '<td>' . $votazione->getDomanda() . '</td>';
    echo '<td><ul>';
    foreach ($risposte as $risposta) {
        echo '<li>' . $risposta["risposta"] . '</li>';
    }
    echo '</ul></td>';
    echo '<td><ul>';
    foreach ($risposte as $risposta) {
        echo '<li>' . $risposta["numeroVoti"] . '</li>';
    }
    echo '</ul></td>';
    echo '</tr>';
    echo '</table>';
    ?>

    <h2>Grafici dei Risultati</h2>

    <div class="grafici-container">
        <canvas id="graficoBarre"></canvas>
        <canvas id="graficoTorta"></canvas>
    </div>

    <script>
        // Dati da PHP
        const etichette = <?php echo json_encode(array_column($risposte, "risposta")); ?>;
        const voti = <?php echo json_encode(array_column($risposte, "numeroVoti")); ?>;
        const titolo = "<?php echo addslashes($votazione->getDomanda()); ?>";

        // Opzioni comuni
        const commonOptions = {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: titolo }
            }
        };

        const colori = [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)'
        ];

        // Grafico a barre
        new Chart(document.getElementById('graficoBarre'), {
            type: 'bar',
            data: {
                labels: etichette,
                datasets: [{
                    label: 'Numero di voti',
                    data: voti,
                    backgroundColor: colori,
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: commonOptions
        });

        // Grafico a torta
        new Chart(document.getElementById('graficoTorta'), {
            type: 'pie',
            data: {
                labels: etichette,
                datasets: [{
                    label: 'Numero di voti',
                    data: voti,
                    backgroundColor: colori,
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: commonOptions
        });
    </script>
</body>

</html>
