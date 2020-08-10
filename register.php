<?php

	include_once (__DIR__ . "/classes/db.php");
	include_once(__DIR__ . "/classes/user.php");

	if (!empty($_POST)){	

		$user = new User();

		$email = $_POST['email'];
		$wachtwoord = $_POST['wachtwoord'];
		$username = $_POST['gebruikersnaam'];

		try{

			$user = new User();

			$user->setEmail($email);
			$user->setPassword($wachtwoord);
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
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Registreren bij Virtual Currency App">
<meta charset="UTF-8">
<title>Registreren bij Virtual Currency App</title>
</head>

<body>

	<div id="banner"></div>

	<div id="geen_lid">
		<p><a href="login.php">Al een account?</a></p>
	</div>

	<div class="registreerField">

		<form action="" method="post">

			<h2>Registreren</h2>

			<?php if(isset($error)): ?>
    		<div class="error"><?php echo $error; ?></div>
    		<?php endif; ?>

			<div>
				<label for="username">Gebruikersnaam</label>
				<input type="text" class="input" name="username" required>
			</div>
			
			<div>
				<label for="Email">Studenten email</label>
				<input type="text" class="input" name="email" required>
			</div>
                
			<div>
				<label for="password">Wachtwoord</label>
				<input type="password" class="input" name="password" required>
			</div>

			<div>
				<input type="submit" value="Aanmelden" class="btn-aanmelden">	
			</div>
	
		</form>

	</div>
</body>
</html>