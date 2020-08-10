<?php

    session_start();

    include_once(__DIR__ . "/classes/db.php");
    include_once(__DIR__ . "/classes/user.php");

    if(empty($_SESSION['email'])){
        header("Location:login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Virtual Currency App">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Virtual Currency App</title>
</head>

<body>

    <div id="banner"></div>

    <div id="links">
        <a href="classes/transaction.php">Geld overmaken</a>
        <a href="logout.php">Logout</a> <br />
    </div>
    
</body>
</html>