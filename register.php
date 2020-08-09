<?php

	include_once (__DIR__ . "/classes/db.php");
	include_once(__DIR__ . "/classes/user.php");

	if (!empty($_POST)){	

		$user = new User();

		$email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
        $balance = $_POST['balans'];
	}

	if(!empty($_POST)){

		try{
			
			$user = new User();
			$salt = "qsdfg23fnjfhuu!";
			$wachtwoord = password_hash($wachtwoord.$salt, PASSWORD_DEFAULT, ['cost' => 12]);
				
			$user->setEmail($_POST['email']);
            $user->setPassword($wachtwoord);
            
            if (strlen($_POST['wachtwoord']) <5){
                throw new Exception ("Wachtwoord moet langer zijn dan 5 karakters.");
            }

			else ($user->save()){
				echo "<script>location='updateUser.php'</script>";
			}
		}

		catch (\Throwable $th){
			$error = $th->getMessage();
		}

    }
    
    else {
        $balance = 10;
    }

	$users = User::getAll();
	  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Aanmelden bij Virtual Currency App</title>
</head>

<body>

	<div id="banner"></div>

	<div id="geen_lid">
		<p>Al een rekening bij VCA? <a href="login.php">Log hier in.</a></p>
	</div>

	<div class="registreerField">

		<form action="" method="post">

			<h2>Registreren</h2>

			<?php if(isset($error)): ?>
    		<div class="error"><?php echo $error; ?></div>
    		<?php endif; ?>

			<div>
				<label for="Email">Email</label>
				<input type="text" class="input" name="email" required>
			</div>
                
			<div>
				<label for="Wachtwoord">Wachtwoord</label>
				<input type="password" class="input" name="wachtwoord" required>
			</div>

			<div>
				<input type="submit" value="Volgende" class="btn-aanmelden">	
			</div>
	
		</form>

	</div>
</body>
</html>