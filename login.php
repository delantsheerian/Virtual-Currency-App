<?php

    include_once(__DIR__ . "/classes/user.php");

	if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $login = new User();
        $login->setEmail($email);
        $login->setPassword($password);
        //$salt = "qsdfg23fnjfhuu!";
        //$login->setPassword($password.$salt);
        //$login->canLogin();

        //if (!$login->canLogin()) {
        if ($login->canLogin()) {
            echo "<script>location='index.php'</script>";
            //$error = "Er liep iets fout.";
        }

        else {
            $error = "Deze combinatie bestaat niet. Probeer nog eens.";
            //$conn = Db::getConnection();
            //$statement = $conn->prepare("select * from users where email = :email");
            //$statement->bindParam(":email", $_SESSION['email']);
            //$statement->execute();
            //$result = $statement->fetch(PDO::FETCH_ASSOC);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Aanmelden bij BitPay">
<title>Aanmelden bij BitPay</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>

    <div class="aanmeldenField">

        <img src="images/logo.png" alt="bitpay logo" class="logo">

        <form action="" method="post">

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