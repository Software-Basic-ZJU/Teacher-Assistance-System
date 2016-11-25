<?php
//header('Content-type: application/json;charset=utf-8');
include '../connectDB.php';

global $conn;
connectDB();
//message(msg_id,content,author,time,msg_state,reply_content)
$reply_content = $_GET['reply_content'];
$msg_id = $_GET['msg_id'];

$reply_message = mysqli_query($conn, "UPDATE message SET reply_content = '$reply_content' WHERE msg_id = '$msg_id'");
if($reply_message)
{
    $result = array(
        "code" => 0,
        "msg" => "回复成功",
        "res" => array(
            "msg_id" => $msg_id,
            "reply_content" => $reply_content,
            )
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else
{
    $result = array(
        "code" => 1,
        "msg" => "回复失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);

?>