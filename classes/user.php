<?php

    include_once ("db.php");

        class User{
            private $email;
            private $password;
            private $balance;
    
            public function getEmail(){
                return $this->email;
            }
    
            public function setEmail($email){
                
                $emailCheck = strrpos($email, "@student.thomasmore.be");
    
                if (empty ($email)){
                    throw new Exception ("Gelieve je email in te voeren.");
                }
    
                if ($emailCheck === false) { 
                    throw new Exception ("Vul een geldig email adress in");
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
    
                $this->password = $password;
                return $this;
            }

        public static function getAll(){

            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users");
            $statement->execute();
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $users;
        }

        public function save(){

            $conn = Db::getConnection();

            if (isset($_POST['email'])) {

                $email = $this->getEmail();
                $conn = Db::getConnection();
                $sql = "SELECT * FROM users WHERE email='$email'";
                $results = $conn->query($sql);

                if ($results->rowCount() > 0) {
                        throw new Exception("Het ingegeven emailadres is al reeds in gebruik.");
                        echo "taken";
                }

                session_start();
                $_SESSION['email'] = $this->email;
            }

		        $statement = $conn->prepare("insert into users (email, wachtwoord) values (:email, :wachtwoord)");

            	$email = $this->getEmail();
            	$wachtwoord = $this->getPassword();

            	$statement->bindValue(":email", $email);
            	$statement->bindValue(":wachtwoord", $wachtwoord);

            	if( $statement->execute() ){
			        return true;
		        }

        }

        public function canLogin() {

            $conn = Db::getConnection();
            $statement = $conn->prepare("select wachtwoord from users where email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            $dbPassword = $statement->fetchColumn();

            if (password_verify($this->password, $dbPassword)) {
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

        public function changeSettings($email, $newpassword){ 
            
            $conn =  Db::getConnection();
            $statement = $conn->prepare("select wachtwoord from users where email = :email");
            $statement->bindParam(":email", $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if(password_verify($newpassword, $result['wachtwoord']) ){
            
                    $conn =  Db::getConnection();
                    $statement = $conn->prepare("UPDATE users SET voornaam=:voornaam, achternaam=:achternaam, profielfoto=:profielfoto, buddy=:buddy, kenmerk1=:woonplaats, kenmerk2=:keuze, kenmerk3=:jaar, kenmerk4=:hobby, kenmerk5=:muziek WHERE email = :email");
                    $statement->bindParam(":email", $email);
            
                    if($statement->execute()){
                        return true;
                    }else{
                        echo "Er is iets foutgelopen bij het updaten.";
                    }

            } else {
                echo "Fout wachtwoord.";
                return false;
            }
        }

        public function countUsers(){
            $conn = Db::getConnection();
            $statement=$conn->prepare("select count(*) as totalUsers from users");
            $statement->execute();
            $result =  $statement->fetch();
            return $result['totalUsers'];
        }
    }
?>