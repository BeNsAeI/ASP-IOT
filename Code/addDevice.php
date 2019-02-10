<?php
ini_set('display_errors', 1);
include 'database.php';
$db = new Database();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  
        $name = $_POST['name'];
        $code = $_POST['code'];
        $radioval = $_POST['radioval'];
        
        $sql = "INSERT INTO `duvoisil-db`.`devices` (`name` ,`code` ,`type`, `row`, `column`) VALUES ('" . $name;
        $sql .= "',  '" . $code . "',  '" . $radioval . "','0','0');";
        $txt = $db->insertQuery($sql);
   
        $myfile = fopen("addDevice-error.txt", "w"); 
        fwrite($myfile, $sql . "--end");
        fclose($myfile);
    }
    else {
        $myfile = fopen("addDevice-error.txt", "w");
        $txt = 'Not Post Request';  
        fwrite($myfile, $txt);
        fclose($myfile);
    }


?>