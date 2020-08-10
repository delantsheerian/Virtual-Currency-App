<?php

	include_once (__DIR__ . "/classes/db.php");
	include_once(__DIR__ . "/classes/user.php");

	if (!empty($_POST)){	

		$user = new User();

		$email = $_POST['email'];
		$wachtwoord = $_POST['wachtwoord'];
		$username = $_POST['gebruikersnaam']

		try{

			$user = new User();

			$user->setEmail($email);
			$user->setPassword($wachtwoord);
			$user->setUsername($username);

			//$salt = "qsdfg23fnjfhuu!";
			//$wachtwoord = password_hash($wachtwoord.$salt, PASSWORD_DEFAULT, ['cost' => 12]);
				
			//if (strlen($_POST['wachtwoord']) <5){
			//	throw new Exception ("Wachtwoord moet langer zijn dan 5 karakters.");
			//}

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
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Registreren bij Virtual Currency App">
<meta charset="UTF-8">
<title>Registreren bij Virtual Currency App</title>
</head>

<body>

	<div id="banner"></div>

	<div id="geen_lid">
		<p>Al een rekening bij VCA? <a href="login.php">Meld je hier aan.</a></p>
	</div>

	<div class="registreerField">

		<form action="" method="post">

			<h2>Registreren</h2>

			<?php if(isset($error)): ?>
    		<div class="error"><?php echo $error; ?></div>
    		<?php endif; ?>

			<div>
				<label for="Gebruikersnaam">Gebruikersnaam</label>
				<input type="text" class="input" name="gebruikersnaam" required>
			</div>
			
			<div>
				<label for="Email">Studenten email</label>
				<input type="text" class="input" name="email" required>
			</div>
                
			<div>
				<label for="Wachtwoord">Wachtwoord</label>
				<input type="password" class="input" name="wachtwoord" required>
			</div>

			<div>
				<input type="submit" value="Aanmelden" class="btn-aanmelden">	
			</div>
	
		</form>

	</div>
</body>
</html>