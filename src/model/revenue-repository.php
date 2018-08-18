<?php

require_once dirname(__FILE__) . '/connection.php';
require_once dirname(__FILE__) . '/revenue.php';
require_once dirname(__FILE__) . '/../commons/response-dto.php';


class RevenueRepository
{

    private $mysqli;

    function __construct()
    {
        $con = new Connection();
        $this->mysqli = $con->getConection();
    }

    function listRevenues()
    {
        $responseDTO = new ResponseDTO();
        $result = $this->mysqli->query("select * from revenue");
        $list = array();
        while ($obj = $result->fetch_object()) {
            $revenue = new Revenue();
            $revenue->setId($obj->id);
            $revenue->setName($obj->name);
            $revenue->setAmount($obj->amount);
            $revenue->setDueDate($obj->due_date);
            $revenue->setReceivedDate($obj->received_date);
            $revenue->setInformation($obj->information);
            array_push($list, $revenue->jsonSerialize());
        }
        $responseDTO->setData($list);
        return $responseDTO->jsonSerialize();
    }

    function createRevenue($revenue)
    {
        $responseDTO = new ResponseDTO();
        $sql = "INSERT INTO `revenue`(`name`, `amount`, `due_date`, `received_date`, `information`)
               VALUES ('{$revenue->getName()}', {$revenue->getAmount()}, {$revenue->getDueDate()},
               {$revenue->getReceivedDate()},' {$revenue->getInformation()}')";

        if ($this->mysqli->query($sql)) {
            $responseDTO->setMessage("New record created successfully");
            $responseDTO->setData($this->mysqli->insert_id);
        } else {
            $responseDTO->setError("Error: " . $this->mysqli->error);
        }
        $this->mysqli->close();
        return $responseDTO->jsonSerialize();
    }

    function updateRevenue($revenue)
    {
        $responseDTO = new ResponseDTO();
        $sql = "UPDATE revenue SET `name`='{$revenue->getName()}', `amount`={$revenue->getAmount()},
                `due_date`={$revenue->getDueDate()},
                `received_date`={$revenue->getReceivedDate()},
                `information`='{$revenue->getInformation()}'
                WHERE id = {$revenue->getId()}";

        if ($this->mysqli->query($sql)) {
            if ($this->mysqli->affected_rows) {
                $responseDTO->setMessage("Updated");
            } else {
                $responseDTO->setMessage("Noting changed");
            }
        } else {
            $responseDTO->setError("Error: " . $this->mysqli->error);
        }
        $this->mysqli->close();
        return $responseDTO->jsonSerialize();
    }

    function deleteRevenue($revenue){
        $responseDTO = new ResponseDTO();
        $sql = "DELETE FROM revenue WHERE id = {$revenue->getId()}";
        if ($this->mysqli->query($sql)) {
            if ($this->mysqli->affected_rows) {
                $responseDTO->setMessage("Deleted");
            } else {
                $responseDTO->setMessage("Noting changed");
            }
        }else {
            $responseDTO->setError("Error: " . $this->mysqli->error);
        }
        $this->mysqli->close();
        return $responseDTO->jsonSerialize();
    }

}