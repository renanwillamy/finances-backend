<?php

  
   
 class Connection {
   private  $connect;
    private $mysqli;

    function Connection()
    {
     
        $USER = 'root';
        $SENHA = 'root';
        $DATABASE = 'finances';


        $this->mysqli = new mysqli("localhost", $USER, $SENHA,$DATABASE) or die(mysql_error());

        /* check connection */
        if ($this->mysqli->connect_errno) {
            echo"Connect failed: %s\n".$this->mysqli->connect_error;
            exit();
        }

        $this->mysqli->set_charset("utf8");

    }

    public function getConection(){
        return $this->mysqli;
    }	

    public function closeConection(){
        return $this->close();
    }	


	}



 ?>
