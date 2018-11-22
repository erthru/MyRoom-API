<?php

    require_once('connect.php');

    $email = $_GET['email'];

    if(!$email){
        $response['error'] = true;
        $response['message'] = 'required field is empty';
        echo json_encode($response);
    }else{

        $query = mysqli_query($con,"SELECT * FROM tb_user WHERE user_email='$email'");
        $result = mysqli_fetch_assoc($query);
        

        $response['error'] = false;
        $response['message'] = 'success.';
        $response['user'] = $result;
        echo json_encode($response);

    }

?>