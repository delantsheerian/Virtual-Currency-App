<?php

    session_start();

    include_once(__DIR__ . "/classes/db.php");
    include_once(__DIR__ . "/classes/user.php");

    if(empty($_SESSION['email'])){
        header("Location:login.php");
    }

    $u = new User;
    $u = $u->countUsers();
    if (!$u) {
        $error = "Er liep iets fout.";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Het IMD Buddy netwerk waar (nieuwe) vriendschappen ontstaan.">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Virtual Currency App</title>
</head>

<body>

    <div id="banner"></div>

    <div id="links">
        <a href="updateUser.php">Update mijn info</a>
        <a href="friendlist.php">Mijn vriendenlijst</a>
        <a href="logout.php">Logout</a> <br />
    </div>

    <div id="resultaten">
        Totaal aantal geregistreerd: <?php echo $u; ?><br />
        Totaal aantal vriendschappen: <?php echo $friends; ?><br />
    </div>
    

</body>

</html>