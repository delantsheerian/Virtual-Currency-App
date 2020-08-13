<?php

	session_start();

    include_once(__DIR__ . "/classes/db.php");
	include_once(__DIR__ . "/classes/transaction.php");
	
	if (!empty($_POST)){
		
		$receiver = $_POST['receiver'];
        $amount = $_POST['amount'];
		$message = $_POST['message'];

		$transaction = new Transaction();
		
		if ($amount < 1){

			echo "Het ingegeven bedrag mag niet kleiner zijn dan 1";
		}

		else if ($amount > $transaction->checkWallet($_SESSION['email'])){
			echo "Saldo ontoereikend.";
		}

		else {
			$transaction->setSender($_SESSION['email']);
			$transaction->setReceiver($receiver);
			$transaction->setAmount($amount);
			$transaction->setMessage($message);
			$transaction->setDate();

			$transaction->sendMoney();
			$transaction->addTokens($transaction->checkWallet($receiver));
			$transaction->retractTokens($transaction->checkWallet($_SESSION['email']));
		}
	}

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
        <nav>
            <ul>
                <li><a href="index.php" class="btn-transaction">Naar overzicht</a></li>
                <li><a href="logout.php" class="btn-logout">Logout</a></li>
            </ul>
        </nav>
    </header>
	
	<div id="main">

		<div class="betaalField">

			<form action="" method="post">

				<h1>Betaling overmaken</h1>

				<div>
					<label for="receiver">Ontvanger</label>
					<input id="autocomplete" type="text" class="input" name="receiver" placeholder="Studenten email">
					<ul id="searchResult"></ul>
				</div>

				<div>
					<label for="amount">Bedrag</label>
					<input type="text" class="input" name="amount" placeholder="Jouw bedrag">
				</div>

				<div>
					<label for="message">Een opmerking toevoegen</label>
					<input type="text" class="input-message" name="message" placeholder="Een opmerking toevoegen">
				</div>

				<div>
					<input type="submit" value="Versturen" class="btn-send">
				</div>
		
			</form>

		</div>

	</div>
</body>
</html>