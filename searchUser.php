<?php 

    session_start();

    include_once(__DIR__ . '/classes/db.php');
    include_once(__DIR__ . '/classes/user.php');

    $user = new User();
    $username = $_POST['user'];

    if(isset($_SESSION['email'])){
    
        $conn = Db::getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email LIKE '%$username%'"); 
        $stmt->execute(); 
        $result = $stmt->fetchAll();

        return $result;
    } 
  
    else {
        header("Location: transaction.php");
    }

?>