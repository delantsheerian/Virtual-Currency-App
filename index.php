<?php

    session_start();

    include_once(__DIR__ . "/classes/db.php");
    include_once(__DIR__ . "/classes/user.php");
    include_once(__DIR__ . "/classes/transaction.php");

    if(empty($_SESSION['email'])){
        header("Location:login.php");
    }

    $transaction = new Transaction();
    $user = new User();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Virtual Currency App">
<title>Overzicht</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="icon" href="images/icon.jpg">
</head>

<body>

    <header>

        <a href="index.php"><img id="logo" src="images/logo.png" alt="logo bitpay"></a>
    
        <nav>
            <ul>
                <li><a href="index.php">Geschiedenis</a></li>
                <li><a href="#">Meldingen</a></li>
                <li><a href="transaction.php">Geld overmaken</a></li>
                <li><a href="#">Mijn account</a></li>
                <li><a href="#">Ondersteuning</a></li>
                <li class="logout"><a href="logout.php" id="logout-btn">Logout</a></li>
            </ul>
        </nav>

    </header>

    <div id="main">

        <div id="overall">

            <h1>Overzicht</h1>

            <div id="saldo">
                <h2>Mijn balans</h2>
                <span><?php echo $transaction->checkWallet($_SESSION['email']); ?></span>
            </div>

            <div id="transactions">

            <h2>Mijn transacties</h2>

                <table class="transactions">

                    <thead>
                        <th>Verzender</th>
                        <th>Bedrag</th>
                        <th>Datum</th>
                        <th></th>
                    </thead>

                    <tbody>
                        <?php 
                            $id = $user->getUserId();
                            $result = $transaction->showTransactions($id);

                            foreach($result as $row) { ?>
                                <tr>
                                    <?php 
                                        $userData = $user->getUserData($row['from_user_id']); ?>
                                        <td><?php echo $userData; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                        <td><?php echo substr($row['date'], 0, 10); ?></td>
                                        <td><a href="transactionDetails.php?id=<?php echo $row['id'];?>">Bekijk details</a></td>
                                </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
    
</body>
</html>