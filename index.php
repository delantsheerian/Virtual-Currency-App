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
<link rel="icon" href="images/icon.jpg">
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script>

    $(document).ready(function(){
        setInterval(function(){
            $("#wallet").load('refresh.php');
        }, 300);
    })

</script>
</head>

<body>

    <header>

        <a href="index.php"><img id="logo" src="images/logo.png" alt="logo bitpay"></a>

        <div id="saldo">
                <p>Mijn balans</p>
                <span id="wallet"><?php echo $transaction->checkWallet($_SESSION['email']); ?></span>
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
        <div id="overall">

            <h1>Overzicht</h1>

            <div id="transactions">

                <?php 
                    $id = $user->getUserId();
                    $result = $transaction->showTransactions($id);

                    foreach($result as $row) { ?>

                        <li><a class="transactie" href="transactionDetails.php?id=<?php echo $row['id'];?>">
                        <?php $userData = $user->getUserData($row['from_user_id']);
                        echo $userData;?> heeft <?php
                        echo $row['amount']; ?> euro overgeschreven op <?php
                        echo substr($row['date'], 0, 10); ?>.
                        </a></li>
                    <?php
                    }
                    ?>
            </div>

        </div>
    </div>
    
</body>
</html>