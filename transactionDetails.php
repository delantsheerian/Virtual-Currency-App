<?php
    session_start();

    include_once(__DIR__ . "/classes/db.php");
    include_once(__DIR__ . "/classes/user.php");
    include_once(__DIR__ . "/classes/transaction.php");

    $transaction = new Transaction();
    $user = new User();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Geld overmaken">
<meta charset="UTF-8">
<title>Geld overmaken</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" href="images/icon.jpg">
</head>

<body>

<header>

    <a href="index.php"><img id="logo" src="images/logo.png" alt="logo bitpay"></a>

    <div id="saldo">
            <p>Mijn balans</p>
            <span id="saldoAantal"><?php echo $transaction->checkWallet($_SESSION['email']); ?></span>
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Overzicht</a></li>
            <li><a href="#">Meldingen</a></li>
            <li><a href="transaction.php">Geld overmaken</a></li>
            <li><a href="#">Mijn account</a></li>
            <li><a href="#">Ondersteuning</a></li>
            <li class="logout"><a href="logout.php" id="logout-btn">Logout</a></li>
        </ul>
    </nav>

</header>
	
	<div id="main">
        
    <h1>Details</h1>

        <table class="transactions">

            <thead>
                <th>Verzender</th>
                <th>Bedrag</th>
                <th>Datum</th>
                <th>Bericht</th>
            </thead>

            <tbody>
                <?php 

                $result = $transaction->showTransactionsDetails($_GET['id']);

                foreach($result as $row) { ?>
                
                <tr> 
                    <?php $userData = $user->getUserData($row['from_user_id']); ?>
                    <td><?php echo $userData; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo substr($row['date'], 0, 10); ?></td>
                    <td><?php echo $row['message']; ?></td>
                </tr>

                <?php
                }    
                ?>
            </tbody>
        
        </table>

    </div>

</body>
</html>