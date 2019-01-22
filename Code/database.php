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

        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
         
        if ($mysqli->connect_errno) {          
            $txt = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        } else {
            $txt = 'Successfully connected to database!';
        }
        fwrite($myfile, $txt);
        fclose($myfile);
        
    }
    function __destruct() {
        $mysqli->close();
    }

    function query($sql) { 
        $result = $mysqli->query($sql);
        return $result->fetch_assoc();
           
    } 
} 




?>