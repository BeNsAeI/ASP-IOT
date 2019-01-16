<?php
    //echo "test1";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['files'])) {
            //echo "In Files";
            $errors = [];
            $path = 'images/';
            $extensions = ['jpg', 'jpeg', 'png'];

            $file_name = "venue-test";
            $file_tmp = $_FILES['files']['tmp_name'][0];
            $file_type = $_FILES['files']['type'][0];
            $file_size = $_FILES['files']['size'][0];
            $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][0])));

            $file = $path . $file_name;

            if (!in_array($file_ext, $extensions)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type . ' ' . $file_ext;
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type . ' ' . $file_size;
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);
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