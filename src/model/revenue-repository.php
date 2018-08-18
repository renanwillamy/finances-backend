<?php

require_once dirname(__FILE__) . '/connection.php';
require_once dirname(__FILE__) . '/revenue.php';


class RevenueRepository {

    private $mysqli;

    function __construct()
    {
        $con = new Connection();
        $this->mysqli = $con->getConection();
    }

    function list(){
        $result = $this->mysqli->query("select * from revenue");
        $list = array();
        while ($obj = $result->fetch_object()) {
            $revenue = new Revenue();
            $revenue->setName($obj->name);
            array_push($list, $revenue->jsonSerialize());
        }
        return $list;
    }

}