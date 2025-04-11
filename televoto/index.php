<?php
if (isset($_GET["messaggio"])) {
    $tipo_messaggio = isset($_GET["tipo"]) ? $_GET["tipo"] : "error";
    $classe_messaggio = $tipo_messaggio == "success" ? "message-success" : "message-error";
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso Utente</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <div class="container " style="min-height: 100vh; align-items: center; justify-content: center; display: flex;">
        <div class="card card-accent " style="max-width: 400px;">
            <div class="text-center mb-4">
                <h1>Accedi</h1>
                <p class="text-muted">Inserisci le tue credenziali per continuare</p>
            </div>
            
            <?php if (isset($_GET["messaggio"])): ?>
                <div class="message <?php echo $classe_messaggio; ?>">
                    <?php echo htmlspecialchars($_GET['messaggio']); ?>
                </div>
            <?php endif; ?>
            
            <form action="gestoreLogin.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Accedi</button>
            </form>
            
            <div class="text-center">

            </div>
        </div>
    </div>
</body>

</html>