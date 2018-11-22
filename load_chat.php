<?php

    require_once('connect.php');

    $user0 = $_GET['user0'];
    $user1 = $_GET['user1'];

    $result = array();

    if(!$user0 || !$user1){
        $response['error'] = true;
        $response['message'] = 'required field is empty.';
        echo json_encode($response);
    }else{

        $query = mysqli_query($con, "SELECT * FROM tb_chat WHERE (chat_sender='$user0' AND chat_receiver='$user1') OR (chat_sender='$user1' AND chat_receiver='$user0') ORDER BY chat_id DESC");
        while($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }

        $response['error'] = false;
        $response['message'] = 'success.';
        $response['result'] = $result;
        echo json_encode($response);

    }

?>