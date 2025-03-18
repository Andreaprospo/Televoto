<?php
require_once("conn.php");
if (!isset($_SESSION)) {
    # code...
    session_start();
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
    <form action="gestioneLogin.php" method="get">
        User: <input type="text" name="username" id="username">
        <input type="submit" value="Posta">
    </form>
    <a href="logoutTEMP.php">logout</a>
    <?php
    print_r($_SESSION);
    ?>
</body>
</html>