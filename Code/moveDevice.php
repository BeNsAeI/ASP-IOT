<?php
ini_set('display_errors', 1);
include 'database.php';
$db = new Database();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  
        $row = $_POST['row'];
        $column = $_POST['column'];
        $code = $_POST['code'];
        
        $sql = 'UPDATE `duvoisil-db`.`devices` SET `row` = "'.$row.'", `column` = "'.$column.'" WHERE `code` = "'.$code.'"   ';
        $txt = $db->insertQuery($sql);
   
        $myfile = fopen("errors/moveDevice-error.txt", "a"); 
        fwrite($myfile, $sql . "--end");
        fclose($myfile);
    }
    else {
        $myfile = fopen("errors/moveDevice-error.txt", "a");
        $txt = 'Not Post Request';  
        fwrite($myfile, $txt);
        fclose($myfile);
    }


?>