<?php
ini_set('display_errors', 1);
include 'database.php';
$db = new Database();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  
        $name = $_POST['name'];
        $code = $_POST['code'];
        $radioval = $_POST['radioval'];
        $row = $_POST['row'];
        $column = $_POST['column'];
        
        $sql = "INSERT INTO `duvoisil-db`.`devices` (`name` ,`code` ,`type`, `row`, `column`) VALUES ('" . $name;
        $sql .= "',  '" . $code . "',  '" . $radioval . "','" . $row . "','" . $column . "');";
        $txt = $db->insertQuery($sql);
   
        $myfile = fopen("errors/addDevice-error.txt", "a"); 
        fwrite($myfile, $sql . "--end");
        fclose($myfile);
    }
    else {
        $myfile = fopen("errors/addDevice-error.txt", "a");
        $txt = 'Not Post Request';  
        fwrite($myfile, $txt);
        fclose($myfile);
    }


?>