<?php

class Database { 
    private $dbhost = 'oniddb.cws.oregonstate.edu';
    private $dbname = 'duvoisil-db';
    private $dbuser = 'duvoisil-db';
    private $dbpass = 'e2dgjLF7I7FKOXc4'; 
    private $mysqli;

    function __construct() {
        $myfile = fopen("sql-error.txt", "w");
        $txt = 'test';        

        $this->mysqli = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

        if ($this->mysqli->connect_errno) {          
            $txt = "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        } else {
            $txt = 'Successfully connected to database!';
        }
        fwrite($myfile, $txt);
        fclose($myfile);
        
    }
    function __destruct() {
        $this->mysqli->close();
    }

    function query($sql) { 
        $result = $this->mysqli->query($sql);
        return $result->fetch_assoc();
           
    } 
} 




?>