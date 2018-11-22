<?php

    require_once('connect.php');

    $email = $_POST['email'];
    $token = $_POST['token'];

    $result = array();

    if(!$email || !$token){
        $response['error'] = true;
        $response['message'] = 'required field is empty.';
        echo json_encode($response);
    }else{

        $query = mysqli_query($con, "INSERT INTO tb_user_token VALUES('$email','$token') ON DUPLICATE KEY UPDATE user_token_token='$token'");
        $token = mysqli_fetch_array($query)['user_token_token'];

        $response['error'] = false;
        $response['message'] = 'token saved.';
        echo json_encode($response);

    }

?>