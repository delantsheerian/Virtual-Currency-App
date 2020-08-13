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

            <div id="saldo">
                <h2>Mijn saldo</h2>
                <?php echo $transaction->checkWallet($_SESSION['email']); ?>
            </div>

            <div id="transactions">

                <h2>Mijn transacties</h2>

                <div>
                    
                        <?php 
                            $id = $user->getUserId();
                            $result = $transaction->showTransactions($id);

                            foreach($result as $row) { ?>
                            <div>
                                <a href="transactionDetails.php?id=<?php echo $row['id'];?>">
                                    <?php 
                                        $userData = $user->getUserData($row['from_user_id']);
                                        echo $userData;
                                        echo $row['amount'];
                                        echo substr($row['date'], 0, 10);
                                    ?>
                                </a>   
                            </div>
                        <?php
                            }    
                        ?>
                </div>
                
            </div>
        
        </div>
    </div>
    
</body>
</html>