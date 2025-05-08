<?php
    require_once("Classi/Utente.php");
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION["utenteCorrente"])){
        header("location: login.php?messaggio=devi fare il login");
    }
    if($_SESSION["utenteCorrente"]->getPrivilegio()!=="A" && $_SESSION["utenteCorrente"]->getPrivilegio()!=="P+A"){
        header("location: home.php?messaggio=non hai i privilegi per accedere a questa pagina");
    }

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/styleCreazioneVotazione.css">
        <link rel="icon" type="image/png" href="CSS/icona.png">

        <title>Creazione Votazione</title>
    </head>
    <body>
        <button onclick="apriNuovoCollegio()">Crea nuovo collegio</button>
        <form action="gestoreCreazioneVotazione.php" method="GET">
            <div id = "superDiv">
            </div>
            <button>Conferma creazione votazione</button>
        </form>
        <a href="home.php">Home</a>
    </body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let superDiv = document.getElementById("superDiv");
        let div = document.createElement("div");
        let label = document.createElement("label");
        label.setAttribute("for", "domanda");
        label.innerHTML = "Domanda: ";
        let input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "domanda");
        input.setAttribute("id", "domanda");
        input.setAttribute("placeholder", "Inserisci la domanda qui");
        div.appendChild(label);
        div.appendChild(input);
        superDiv.appendChild(div);
        for(let i = 0; i < 4; i++)
        {
            let sottoDiv = document.createElement("div");
            let label = document.createElement("label");
            let input = document.createElement("input");
            input.setAttribute("type", "text");
            input.setAttribute("name", "risposta" + i);
            input.setAttribute("id", "risposta" + i);
            input.setAttribute("placeholder", "Risposta " + (i+1));
            label.setAttribute("for", "risposta" + i);
            label.innerHTML = "Risposta " + (i+1) + ": ";
            sottoDiv.appendChild(label);
            sottoDiv.appendChild(input);
            superDiv.appendChild(sottoDiv);
        }

    });

    async function apriNuovoCollegio() {
        let url = "ajax/creazioneCollegio.php";
        let response = await fetch(url);
        let txt = await response.text();
        console.log(txt);
        let data = JSON.parse(txt);
        console.log(data);

        if(data.status == "OK"){
            alert(data.msg);
        } else {
            alert("Errore: " + data.msg);
        }
    }
</script>