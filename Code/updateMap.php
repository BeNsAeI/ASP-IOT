<?php
include 'database.php';
$db = new Database();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['files'])) {
            $errors = [];
            $path = 'images/';
            $extensions = ['jpg', 'jpeg', 'png'];

            $file_name = $_FILES['files']['name'][0];
            $file_tmp = $_FILES['files']['tmp_name'][0];
            $file_type = $_FILES['files']['type'][0];
            $file_size = $_FILES['files']['size'][0];
            $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][0])));

            $file = $file_name;

            $rows = $_POST['rows'];
            $cols = $_POST['cols'];

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type . ' ' . $file_ext;
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type . ' ' . $file_size;
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);
                $img_size = getimagesize($file);
                $img_width = $img_size[1];
                $img_height = $img_size[0];
                
                $sql = "INSERT INTO `duvoisil-db`.`map` (`File` ,`Rows` ,`Columns`) VALUES ('" . $file .
                $sql .= "',  '" . $rows . "',  '" . $cols . "');";
                $txt = $db->query($sql);

            }
            if ($errors) print_r($errors);
        }
        else{
            echo "Files not set";
        }     
    }
    else {
        echo "Not Post";
    }


?>