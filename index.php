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
<title>Overzicht</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" href="images/icon.jpg">
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="transaction.php" class="btn-transaction">Geld overmaken</a></li>
                <li><a href="logout.php" class="btn-logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div id="main">

        <div id="overall">

            <h1>Overzicht</h1>

            <div id="saldo"></div>

            <div id="transactions"></div>
        
        </div>
    </div>
    
</body>
</html>