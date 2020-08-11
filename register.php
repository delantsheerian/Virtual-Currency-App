<?php

	include_once (__DIR__ . "/classes/db.php");
	include_once(__DIR__ . "/classes/user.php");

	if (!empty($_POST)){	

		$user = new User();

		$email = $_POST['email'];
		$password = $_POST['password'];
		$username = $_POST['username'];

		try{

			$user = new User();

			$user->setEmail($email);
			$user->setPassword($password);
			$user->setUsername($username);

			if ($user->save()){
				echo "<script>location='login.php'</script>";
			}
		}

		catch (\Throwable $th){
			$error = $th->getMessage();
		}
}
	  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Registreren bij BitPay">
<meta charset="UTF-8">
<title>Registreren bij BitPay</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" href="images/icon.jpg">

</head>

<body>

	<div class="registreerField">

		<form action="" method="post">

			<h1>Registreren</h1>

			<?php if(isset($error)): ?>
    		<div class="error"><?php echo $error; ?></div>
    		<?php endif; ?>

			<div>
				<label for="username">Gebruikersnaam</label>
				<input type="text" class="input" name="username" placeholder="Kies jouw gebruikersnaam" required>
			</div>
			
			<div>
				<label for="email">Studenten email</label>
				<input type="text" class="input" name="email" placeholder="Geef hier jouw studenten email in" required>
			</div>
                
			<div>
				<label for="password">Wachtwoord</label>
				<input type="password" class="input" name="password" placeholder="Kies jouw wachtwoord"required>
			</div>

			<div class="buttons">
				<input type="submit" value="Aanmelden" class="btn-login">
				<a class="btn-already-account" href="login.php">Al een account?</a>
			</div>
	
		</form>

	</div>
</body>
</html>