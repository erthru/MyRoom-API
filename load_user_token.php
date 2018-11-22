<?php

    require_once('connect.php');

    $email = $_GET['email'];

    $result = array();

    if(!$email){
        $response['error'] = true;
        $response['message'] = 'required field is empty.';
        echo json_encode($response);
    }else{

        $query = mysqli_query($con, "SELECT user_token_token FROM tb_user_token WHERE user_token_email='$email'");
        $token = mysqli_fetch_array($query)['user_token_token'];

        $response['error'] = false;
        $response['message'] = 'success.';
        $response['token'] = $token;
        echo json_encode($response);

    }

?>