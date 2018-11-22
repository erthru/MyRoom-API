<?php

    $token = $_GET['token'];
    $body = $_GET['body'];

    $FIREBASE_SERVER = 'AAAAhUqtAnk:APA91bE3PI-SjaQU_rjaST_02Ov4vPLPevJAVzDzKu8oG_s59VlxZftfEn2cZkmtrWhfykqTevOLvf-hG2roqxA3gSq37NeFZ80GnBo92j6lfyTNb2t_h-nmR9EPyZ1Wm4R8qruBFfPy';

    if(!$token || !$body){
        $response['error'] = true;
        $response['message'] = 'required field is empty.';
        echo json_encode($response);
    }else{

        $msg = array
           (
      'body' 	=> $body,
               'icon'	=> 'myicon',
                 'sound' => 'mySound'
           );
      $fields = array
       (
         'to'		=> $token,
         'notification'	=> $msg,
         'data' => array(
                'key' => 'NULL'
             )
       );
       
      $headers = array
       (
         'Authorization: key = '.$FIREBASE_SERVER,
         'Content-Type: application/json'
       );
      $ch = curl_init();
      curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
      curl_setopt( $ch,CURLOPT_POST, true );
      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
     
      $result = curl_exec($ch );
      curl_close( $ch );
      echo $result;

    }

?>