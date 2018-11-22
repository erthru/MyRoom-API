<?php

    require_once('connect.php');

    $email = $_GET['email'];

    if(!$email){
        $response['error'] = true;
        $response['message'] = 'required field is empty';
        echo json_encode($response);
    }else{
        
        $checkedEmail = null;

        $query = mysqli_query($con,"SELECT user_email FROM tb_user WHERE user_email='$email'");
        while($row = mysqli_fetch_array($query)){
            $checkedEmail = $row['user_email'];
        }

        if(strtolower($checkedEmail) == strtolower($email)){
            $response['error'] = false;
            $response['message'] = 'exist';
            echo json_encode($response);
        }else{
            $response['error'] = true;
            $response['message'] = 'not exist';
            echo json_encode($response);
        }
    
    }

?>