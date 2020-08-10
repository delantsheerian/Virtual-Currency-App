<?php
    class Transaction {
        private $amount;
        private $from_user_id;
        private $to_user_id;
        private $message;
        private $date;
    }

    public function getAmount(){
        return $this->balance;
    }

    public function setAmount(){
        if (empty ($amount)){
            throw new Exception ("Gelieve een bedrag in te voeren.");
        }

        $this->amount = $amount;
        return $this;
    }

    public function getSender(){
        return $this->sender;
    }

    public function setSender(){
        if (empty ($from_user_id)){
            throw new Exception ("Gelieve een bestaande gebruiker in te voeren.");
        }
    }

    public function getReceiver(){
        return $this->receiver;
    }

    public function setReceiver(){
        if (empty ($to_user_id)){
            throw new Exception ("Gelieve een bestaande gebruiker in te voeren.");
        }
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage(){
        $this->message = $message;
        return $this;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate(){
        $this->date = $date;
        return $this;
    }
?>