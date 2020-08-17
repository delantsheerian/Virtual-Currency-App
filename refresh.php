<?php 

    session_start();

    include_once(__DIR__ . '/classes/transaction.php');

    $transaction = new Transaction();

    if(isset($_SESSION['email'])){
    echo $transaction->checkWallet($_SESSION['email']);
    } 
  
    else {
        header("Location: inloggen.php");
    }

?>

  