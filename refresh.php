<?php 

    session_start();
    
    include_once(__DIR__ . '/classes/user.php');
    include_once(__DIR__ . '/classes/transaction.php');

    $user = new User();

    if(isset($_SESSION['email'])){

        $username = $user->getUserId('email');
        $_SESSION['email'] = $username['id'];
        echo $user['tokens']; 
    
    } 
    
    else {
        header("Location: index.php");
    }

  ?>