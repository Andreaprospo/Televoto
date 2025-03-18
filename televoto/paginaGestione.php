<?php
session_start();

// Simulazione del privilegio (da rimuovere in produzione)
if (!isset($_SESSION['privilegio'])) {
    $_SESSION['privilegio'] = 'A'; // Cambia il valore per testare ('A', 'B', 'C')
}

// Recupera il privilegio dalla sessione
$privilegio = $_SESSION['privilegio'];

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Privilegi</title>
    <style>
        .button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
            border: none;
            color: white;
            cursor: pointer;
        }
        .buttonA { background-color: blue; }
        .buttonB { background-color: green; }
        .buttonC { background-color: red; }
    </style>
</head>
<body>

<h2>Benvenuto nella pagina dinamica</h2>

<?php
// Mostra il pulsante corrispondente al privilegio
if ($privilegio == 'A') {
    echo '<button class="button buttonA">Pulsante A</button>';
} elseif ($privilegio == 'B') {
    echo '<button class="button buttonB">Pulsante B</button>';
} elseif ($privilegio == 'C') {
    echo '<button class="button buttonC">Pulsante C</button>';
} else {
    echo '<p>Privilegio non riconosciuto.</p>';
}
?>

</body>
</html>