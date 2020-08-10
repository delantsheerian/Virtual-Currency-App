<?php

    include_once(__DIR__ . "/classes/user.php");

	if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $login = new User();
        $login->setEmail($email);
        $salt = "qsdfg23fnjfhuu!";
        $login->setPassword($password.$salt);
        $login->canLogin();

        if (!$login->canLogin()) {
            $error = "Er liep iets fout.";
        }

        else {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindParam(":email", $_SESSION['email']);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Aanmelden bij Virtual Currency App">
<title>Aanmelden bij Virtual Currency App</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>

    <div class="aanmeldenField">

        <form action="" method="post">

            <h1>Virtual Currency App</h1>

            <?php if(isset($error)): ?>
    		<div class="error"><?php echo $error; ?></div>
    		<?php endif; ?>

            <div>
                <label for="email" required>Studenten Email</label>
                <input class="input" type="text" name="email" placeholder="Studenten email">
            </div>

            <div>
                <label for="password">Wachtwoord</label>
                <input class="input" type="password" name="password" placeholder="Wachtwoord">
            </div>

            <div>
                <input type="submit" class="btn-aanmelden" value="Aanmelden">
                <a class="btn-register" href="register.php">Nog geen account?</a>
            </div>

            </div>
        </form>

    </div>
</body>
</html>