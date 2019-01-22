<?php
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

            $file = $path . $file_name . $file_ext;

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type . ' ' . $file_ext;
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type . ' ' . $file_size;
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);

                $sql = "INSERT INTO `duvoisil-db`.`map` (`File` ,`Rows` ,`Columns`) VALUES ('";
                $sql .= $file; 
                $sql .= "',  '10',  '10');";
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