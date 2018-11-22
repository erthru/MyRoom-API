<?php

    require_once('connect.php');

    $email = $_GET['email'];

    if(!$email){
        $response['error'] = true;
        $response['message'] = 'required field is empty';
        echo json_encode($response);
    }else{

        $result = null;

        $query = mysqli_query($con,"SELECT * FROM tb_user WHERE user_email='$email'");
        while($row = mysqli_fetch_assoc($query)){
            $result = $row;
        }

        $response['error'] = false;
        $response['message'] = 'success.';
        $response['user']['user_email']=$result['user_email'];
        $response['user']['user_name']=$result['user_name'];
        $response['user']['user_photo']=$result['user_photo'];
        echo json_encode($response);

    }

?>