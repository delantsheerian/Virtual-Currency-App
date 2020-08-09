<?php
    
    session_start();

    include_once(__DIR__ . "/classes/db.php");
    include_once(__DIR__ . "/classes/user.php");

    if(empty($_SESSION['email'])){
        header("Location:login.php");
    }

    if(!empty($_POST)){

        $u = new User();
        $email = $_SESSION['email'];
        $walletValue = $_POST['walletvalue'];

        $newpassword = "";
        if(!empty($_POST['newPassword'])) {
            $salt = "qsdfg23fnjfhuu!";
            $newpassword = $_POST['newPassword'].$salt;
        } 

        define ('SITE_ROOT', realpath(dirname(__FILE__)));

        $result = $u->changeSettings($email, $newpassword, $walletValue);

        if($result === true){
            echo "<script>location='index.php'</script>";
        }
        
        else{
            echo $result;
        }
    }

    $conn =  Db::getConnection();
    $statement = $conn->prepare("SELECT * FROM users WHERE email = '" . $_SESSION['email'] . "'");
    $statement->execute();
    if( $statement->rowCount() > 0){
        $user = $statement->fetch();
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Mijn profiel</title>
</head>
<body>

    <header class="header">
    <div class="container">
        <div class="wrapper">
        <h1 class="logo"><a href="index.php">VCA</a></h1>
        <a class="nav-toggle">
            <span class="toggle"></span>
            <span class="toggle"></span>
            <span class="toggle"></span>
        </a>
        </div>
        <nav class="navbar">
        <ul class="nav-menu">
            <li class="nav-item"><a href="index.php">Home</a></li>
            <li class="nav-item"><a href="updateUser.php">Mijn profiel</a></li>
            <li class="nav-item"><a href="tansfer.php">Geld overmaken</a></li>
        <li class="nav-item"><a href="logout.php">Afmelden</a></li>
        </nav>
    </div>
    </header>

    <div id="banner"></div>

    <div class="editField">
        <form class="password-form" method="POST" action="" enctype="multipart/form-data" id="upload-form">

                <div id="form_title">
                <h2>Mijn profiel bijwerken</h2>
                </div>

                <div class="registrerenBuddy">

                <div> 
                <label>Jouw email:</label> 
                <input class="input" type="text" name="newEmail" placeholder="">
                </div> 

                <div> 
                <label>Jouw wachtwoord:</label> 
                <input class="input" type="password" name="newPassword" placeholder="">
                </div> 

                <input class="btn-aanmelden" type="submit" value="Submit">
        </form>
</div>

</body>
</html>