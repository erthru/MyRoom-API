<?php

    require_once('connect.php');

    $body = $_POST['body'];
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];

    if(!$body || !$sender || !$receiver){
        $response['error'] = true;
        $response['message'] = 'required field is empty.';
        echo json_encode($response);
    }else{

        $query = mysqli_query($con,"INSERT INTO tb_chat (chat_body,chat_sender,chat_receiver) VALUES ('$body','$sender','$receiver')");

        if($query){
            $response['error'] = false;
            $response['message'] = 'new chat created.';
            echo json_encode($response);
        }else{
            $response['error'] = true;
            $response['message'] = 'new chat failed.';
            echo json_encode($response);
        }

    }

?>