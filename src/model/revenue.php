<?php 

class Revenue { 
    private $id;
    private $name;
    private $amount;
    private $dueDate;
    private $receivedDate;
    private $information;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function setAmount($amount){
        $this->amount = $amount;
    }

    public function getDueDate(){
        return $this->dueDate;
    }

    public function setDueDate($dueDate){
        $this->dueDate = $dueDate;
    }

    public function getReceivedDate(){
        return $this->receivedDate;
    }

    public function setReceivedDate($receivedDate){
        $this->receivedDate = $receivedDate;
    }

    public function getInformation(){
        return $this->information;
    }

    public function setInformation($information){
        $this->information = $information;
    }

    public function jsonSerialize() {
		return get_object_vars($this);
	}

} 
