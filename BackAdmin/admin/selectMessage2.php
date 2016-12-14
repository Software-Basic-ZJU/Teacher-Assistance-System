<?php

header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

$query_message = mysqli_query($conn, "select * from message where msg_state = 1");
if($fetched = mysqli_fetch_array($query_message))
{
    //message(msg_id,content,author,time,msg_state,reply_content)
    $message = array();
    do{ 
        $message[] = array(
            "msg_id" => $fetched['msg_id'],
            "content" => $fetched['content'],
            "author" => $fetched['author'],
            "time" => $fetched['time'],
            //"reply_content" => $fetched['reply_content']
        );
    }while($fetched = mysqli_fetch_array($query_message));
    $result = array(
        "code" => 0,
        "msg" => "读取成功",
        "res" => $message
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "读取失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);
?>