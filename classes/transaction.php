<?php

    include_once ("db.php");

    class Transaction {
        private $amount;
        private $from_user_id;
        private $to_user_id;
        private $message;
        private $date;

    public function getAmount(){
        return $this->amount;
    }

    public function setAmount($amount){
        if (empty ($amount)){
            throw new Exception ("Gelieve een bedrag in te voeren.");
        }

        $this->amount = $amount;
        return $this;
    }

    public function getSender(){
        return $this->from_user_id;
    }

    public function setSender($from_user_email){

        if (empty ($from_user_email)){
            throw new Exception ("Gelieve een bestaande gebruiker in te voeren.");
        }

        $conn = Db::getConnection();
        
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = '$from_user_email' LIMIT 1"); 
        $stmt->execute(); 
        $result = $stmt->fetchColumn();

        $this->from_user_id = $result;

    }

    public function getReceiver(){
        return $this->to_user_id;
    }

    public function setReceiver($to_user_email){

        if (empty ($to_user_email)){
            throw new Exception ("Gelieve een bestaande gebruiker in te voeren.");
        }

        $conn = Db::getConnection();
        
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = '$to_user_email' LIMIT 1"); 
        $stmt->execute(); 
        $result = $stmt->fetchColumn();

        $this->to_user_id = $result;

    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){
        $this->message = $message;
        return $this;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate(){
        $this->date = date("Y-m-d H:i:s");
        return $this;
    }

    public function sendMoney(){
        
        $conn = Db::getConnection();

        $statement = $conn->prepare("insert into transactions (from_user_id,  to_user_id, amount, date, message) values (:from_user_id,  :to_user_id, :amount, :date, :message)");

        $sender = $this->getSender();
        $receiver = $this->getReceiver();
        $amount = $this->getAmount();
        $message = $this->getMessage();
        $date = $this->getDate();
            
        $statement->bindValue(":from_user_id", $sender);
        $statement->bindValue(":to_user_id", $receiver);
        $statement->bindValue(":amount", $amount);
        $statement->bindValue(":date", $date);
        $statement->bindValue(":message", $message);

        if($statement->execute()){
            return true;
        }
    }

    public function checkWallet($email){

        $conn = Db::getConnection();
        
        $stmt = $conn->prepare("SELECT tokens FROM users WHERE email = '$email' LIMIT 1"); 
        $stmt->execute(); 
        $result = $stmt->fetchColumn();

        return $result;
    }

    public function addTokens($wallet){

        $conn = Db::getConnection();
        
        $total = $wallet + $this->amount;
        $sql = "UPDATE users SET tokens=:tokens WHERE id=$this->to_user_id";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(':tokens', $total);
        $stmt->execute();
    }

    public function retractTokens($wallet){
        
        $conn = Db::getConnection();

        $total = $wallet - $this->amount;
        $sql = "UPDATE users SET tokens=:tokens WHERE id=$this->from_user_id";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(':tokens', $total);
        $stmt->execute();

        echo $total;
        echo $wallet;
    }

    public function showTransactions($email){

        $conn = Db::getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM transactions WHERE from_user_id = '$email'"); 
        $stmt->execute(); 
        $result = $stmt->fetchAll();

        return $result;
    }

    public function showTransactionsDetails($id){

        $conn = Db::getConnection();
        
        $stmt = $conn->prepare("SELECT * FROM transactions WHERE id = '$id'"); 
        $stmt->execute(); 
        $result = $stmt->fetchAll();

        return $result;
    }
}
?>