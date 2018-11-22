<?php

    require_once('connect.php');

    $email = $_POST['email'];
    $name = $_POST['name'];

    if(!$email || !$name){
        $response['error'] = true;
        $response['message'] = 'required field is empty';
        echo json_encode($response);
    }else{
        
        $query = mysqli_query($con,"UPDATE tb_user SET user_name='$name' WHERE user_email='$email'");

        if($query){
            $response['error'] = false;
            $response['message'] = 'user updated.';
            echo json_encode($response);
        }else{
            $response['error'] = true;
            $response['message'] = 'user failed to update.';
            echo json_encode($response);
        }

    }

?>