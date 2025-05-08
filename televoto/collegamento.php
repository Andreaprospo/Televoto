<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collegamento</title>
    <link rel="stylesheet" href="CSS/styleCollegamento.css">
</head>
<body>
    <div class="container">
        <h1>Collegamento</h1>
        <input type="text" name="idTelecomando" id="idTelecomando" placeholder="ID del telecomando" required>
        <button onclick="creaCollegamento()">Collega</button>
    </div>

    <!-- Bottone Home separato -->
    <div class="home-button-wrapper">
        <a href="home.php" class="button-secondary">Home</a>
    </div>

    <script>
        async function creaCollegamento() {
            const idTelecomando = document.getElementById("idTelecomando").value;
            let url = "ajax/creaCollegamento.php?idTelecomando=" + encodeURIComponent(idTelecomando);
            try {
                let response = await fetch(url);
                let txt = await response.text();
                console.log(txt);
                let json = JSON.parse(txt);
                if (json.status === "OK") {
                    alert("Collegamento creato con successo!");
                } else {
                    alert("Errore: " + json.message);
                }
            } catch (err) {
                alert("Errore nella comunicazione col server.");
                console.error(err);
            }
        }
    </script>
</body>
</html>
