<?php
require_once("conn.php");
if(!isset($_SESSION))
{
    session_start();
}

if($_SESSION["loggato"] != true)
{
    header("location: index.php?=Utente non autenticato");
    exit;
}

if($_SESSION["privilegio"] != "P" || $_SESSION["privilegio"] != "P+A" )
{
    header("location: index.php?=Privilegi non conformi");
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $sql = "SELECT v.domanda, r.risposta FROM votazioni v JOIN risposte r ON v.IDvotazione = r.IDvotazione WHERE v.IDvotazione = ( SELECT IDvotazione FROM votazioni ORDER BY IDcollegio DESC LIMIT 1);";
    $result = $mysqli->query($sql);
    if($result->num_rows > 0)
    {
        $currentQuestion = "";
        echo "<ul>";
        while($row = $result->fetch_assoc())
        {
            if ($currentQuestion != $row["domanda"]) {
                if ($currentQuestion != "") {
                    echo "</ul>";
                }
                $currentQuestion = $row["domanda"];
                echo "<h1>".$currentQuestion."</h1>";
                echo "<h2>Risposte:</h2>";
                echo "<ul>";
            }
            echo "<li>".$row["risposta"]."</li>";
        }
        echo "</ul>";
    }
    else
    {
        echo "Nessuna votazione trovata.";
    }
    ?>
</body>
</html>