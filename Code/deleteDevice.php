<?php
ini_set('display_errors', 1);
include 'database.php';
$db = new Database();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  
        $code = $_POST['code'];
        
        $sql = 'DELETE FROM `duvoisil-db`.`devices` WHERE code = "' . $code .'";';
        $txt = $db->deleteQuery($sql);
   
        $myfile = fopen("errors/deleteDevice-error.txt", "a"); 
        fwrite($myfile, $sql . "--end");
        fclose($myfile);
    }
    else {
        $myfile = fopen("errors/deleteDevice-error.txt", "a");
        $txt = 'Not Post Request';  
        fwrite($myfile, $txt);
        fclose($myfile);
    }


?>