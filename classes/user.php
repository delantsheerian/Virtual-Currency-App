<?php

    include_once ("db.php");

        class User{
            private $email;
            private $password;
            private $balance;
            private $username;

            public function getUsername(){
                return $this->username;
            }

            public function setUsername($username){
               
                if (empty ($username)){
                    throw new Exception ("Gelieve een gebruikersnaam in te voeren.");
                }

                $this->username = $username;
                return $this;
            }
    
            public function getEmail(){
                return $this->email;
            }
    
            public function setEmail($email){
                
                $emailCheck = strrpos($email, "@student.thomasmore.be");
    
                if (empty ($email)){
                    throw new Exception ("Gelieve je studenten email in te voeren.");
                }
    
                if ($emailCheck === false) { 
                    throw new Exception ("Vul een geldige studenten email in");
                }
        
                $this->email = $email;
                return $this;
            }
    
            public function getPassword(){
                return $this->password;
            }
    
            public function setPassword($password){
    
                if (empty ($password)){
                    throw new Exception ("Gelieve een wachtwoord in te voeren.");
                }

                if (strlen($password) < 5){
                    throw new Exception ("Gelieve een wachtwoord langer dan 5 tekens in te voeren.");
                }

                $options = ['cost' => 12,];
				$password = password_hash($password , PASSWORD_DEFAULT , $options);
    
                $this->password = $password;
                return $this;
            }

            public function getBalance(){
                return $this->balance;
            }
    
            public function setBalance($balance){
    
                $this->balance = $balance;
                return $this;
            }

            public function save(){

                $conn = Db::getConnection();

                if(isset($_POST['email'])){

                    $email = $this->getEmail();
                    $conn = Db::getConnection();
                    $sql = "SELECT * FROM users WHERE email='$email'";
                    $results = $conn->query($sql);
    
                    if($results->rowCount() > 0) {
                        throw new Exception("Het ingegeven emailadres is al reeds in gebruik.");
                    }
    
                    session_start();
                    $_SESSION['email'] = $this->email;
                }
                
                $statement = $conn->prepare("insert into users (active, email, password, username, tokens) values (1, :email, :password, :username, 10)");

                $email = $this->getEmail();
                $password = $this->getPassword();
                $username = $this->getUsername();
            

                $statement->bindValue(":email", $email);
                $statement->bindValue(":password", $password);
                $statement->bindValue(":username", $username);

                if($statement->execute()){
                    return true;
                }

            }

            public function canLogin() {

                $conn = Db::getConnection();
                $statement = $conn->prepare("select password from users where email = :email");
                $statement->bindValue(":email", $this->email);
                $statement->execute();
                $dbPassword = $statement->fetchColumn();

                if (password_verify($_POST["password"], $dbPassword)) {
                    session_start();
                    $_SESSION['email'] = $this->email;
                    return true;
                }
            }

            public function getUserID(){
			
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from users where email = :email");
                $statement->bindValue(":email", $_SESSION['email']);
                $statement->execute();
                $result =  $statement->fetch();
                return $result['id'];
            }
    }
?>