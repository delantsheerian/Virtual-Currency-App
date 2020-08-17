<?php

	session_start();

    include_once(__DIR__ . "/classes/db.php");
	include_once(__DIR__ . "/classes/transaction.php");

	$transaction = new Transaction();
	
	if (!empty($_POST)){
		
		$receiver = $_POST['receiver'];
        $amount = $_POST['amount'];
		$message = $_POST['message'];
		
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
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script language="javascript">

    refreshPage();

    function refreshPage(){
        $.ajax ({
            url: "refresh.php",
            success: 
                function(result){
                    $('#wallet').text(result);
                    setTimeout(function(){
                        refreshPage();
                    }, 10000);
                }
        });
    }
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

		<div class="betaalField">

			<form action="" method="post">

				<h1>Betaling overmaken</h1>

				<div>
					<label for="receiver">Ontvanger</label>
					<input id="autocomplete" type="text" class="input" name="receiver" placeholder="Studenten email">
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

<script>

	$('#autocomplete').keyup(function(){
		
		var ac = $('#autocomplete').val();
		searchUser(ac);

	});

	function searchUser(ac){
		$.ajax ({
			type: "POST",
			data: { user: ac },
			url: "searchUser.php",
			success: 
				function(result){
					console.log(result);
				}
		});
	}

</script>

</body>
</html>