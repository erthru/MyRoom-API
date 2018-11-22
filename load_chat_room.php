<?php

    require_once('connect.php');

    $email = $_GET['email'];

    $result = array();

    if(!$email){
        $response['error'] = true;
        $response['message'] = 'required field is empty.';
        echo json_encode($response);
    }else{

        $query = mysqli_query($con, "SELECT chat_id,chat_sender as a_chat_sender,chat_receiver as a_chat_receiver,chat_created_at,
        (SELECT user_name FROM tb_user WHERE user_email=chat_sender) as chat_sender_name,
        (SELECT user_name FROM tb_user WHERE user_email=chat_receiver) as chat_receiver_name,
        (SELECT user_photo FROM tb_user WHERE user_email=chat_sender) as chat_sender_photo,
        (SELECT user_photo FROM tb_user WHERE user_email=chat_receiver) as chat_receiver_photo,
        (SELECT chat_body FROM tb_chat WHERE (chat_sender=a_chat_sender AND chat_receiver=a_chat_receiver) OR (chat_sender=a_chat_receiver AND chat_receiver=a_chat_sender) ORDER BY chat_id DESC LIMIT 1) as chat_body

        FROM tb_chat 
        WHERE chat_sender='$email' OR chat_receiver='$email'
        GROUP BY CONCAT(GREATEST(chat_sender,chat_receiver), '-', LEAST(chat_sender,chat_receiver))
        ORDER BY chat_id DESC");

        while($row = mysqli_fetch_assoc($query)){

            $bug = $row['a_chat_sender'].$row['a_chat_receiver'];
            $sender = str_replace($email,'',$bug);
            $query1 = mysqli_query($con,"SELECT SUM(chat_unread+0) as chat_unread FROM tb_chat WHERE chat_receiver='$email' AND chat_sender='$sender'");

            $row['chat_unread'] = mysqli_fetch_array($query1)['chat_unread'];

            $result[] = $row;
        
        }

        $response['error']=false;
        $response['message']='success';
        $response['result']=$result;
        echo json_encode($response);

    }

?>