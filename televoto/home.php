<?php
require_once("Classi/Utente.php");
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["utenteCorrente"])) {
    header("location: index.php?message=devi fare il login");
    exit;
}


?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Riservata</title>
    <link rel="stylesheet" href="CSS/styleHome.css">
</head>
<body>

    <div class="card">
        <h1>Benvenuto</h1>

        <?php 
            if (isset($_GET["messaggio"]))
            {
                echo '<div class="message-box">';
                echo htmlspecialchars($_GET["messaggio"]);
                echo "</div>";
            }
        ?>
        <?php
        $isAdmin = false;
        $isPrivilegiato = false;

        $privilegio = $_SESSION["utenteCorrente"]->getPrivilegio();
        if ($privilegio === "P+A") {
            $isAdmin = $isPrivilegiato = true;
        } elseif ($privilegio === "A") {
            $isAdmin = true;
        } elseif ($privilegio === "P") {
            $isPrivilegiato = true;
        }
        ?>

        <div class="button-group">
            <a href="dettagliVotazione.php" class="button">Pagina Votazione</a>
            <a href="collegamento.php" class="button">Collega Telecomando</a>

            <?php if ($isAdmin): ?>
                <a href="creazioneVotazione.php" class="button">Crea votazione</a>
            <?php endif; ?>

            <?php if ($isPrivilegiato): ?>
                <a href="storico.php" class="button">Storico Privilegiato</a>
            <?php endif; ?>
        </div>

        <a href="logout.php" class="button logout">Logout</a>
    </div>

</body>
</html>
