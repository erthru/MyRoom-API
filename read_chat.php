<?php

    require_once('connect.php');

    $sender = $_GET['sender'];
    $receiver = $_GET['receiver'];

    if(!$sender || !$receiver){
        $response['error'] = true;
        $response['message'] = 'required field is empty.';
        echo json_encode($response);
    }else{

        $query = mysqli_query($con,"UPDATE tb_chat SET chat_unread=0 WHERE chat_sender='$sender' AND chat_receiver='$receiver'");

        $response['error'] = false;
        $response['message'] = 'chat read.';
        echo json_encode($response);

    }


?>