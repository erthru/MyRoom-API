<?php

    require_once('connect.php');

    $email = $_POST['email'];
    $name = $_POST['name'];
    $photo = $_FILES['photo'];

    if(!$email || !$name || !$photo){
        $response['error'] = true;
        $response['message'] = 'required field is empty';
        echo json_encode($response);
    }else{
        
        $serverpath = '/anows/myroom/img/';
        $photo_file_name = uniqid().'.jpg';
        move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $serverpath . $photo_file_name);

        $query = mysqli_query($con,"INSERT INTO tb_user VALUES ('$email','$name','$photo_file_name')");

        if($query){
            $response['error'] = false;
            $response['message'] = 'new user created.';
            echo json_encode($response);
        }else{
            $response['error'] = true;
            $response['message'] = 'new user failed.';
            echo json_encode($response);
        }

    }

?>