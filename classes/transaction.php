<?php
    class Transaction {
        private $amount;
        private $sender;
        private $receiver;
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
        if (empty ($sender)){
            throw new Exception ("Gelieve een bestaande gebruiker in te voeren.");
        }
    }

    public function getReceiver(){
        return $this->receiver;
    }

    public function setReceiver(){
        if (empty ($receiver)){
            throw new Exception ("Gelieve een bestaande gebruiker in te voeren.");
        }
    }
?>