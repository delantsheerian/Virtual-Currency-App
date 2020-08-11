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

		<div class="registreerField">

			<form action="" method="post">

				<h1>Betaling overmaken</h1>

				<div>
					<label for="username">Ontvanger</label>
					<input type="text" class="input" name="username" placeholder="Naam of studenten email">
				</div>

				<div>
					<label for="amount">Bedrag</label>
					<input type="text" class="input" name="username" placeholder="Jouw bedrag">
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