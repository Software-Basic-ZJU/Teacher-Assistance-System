<?php
//header('Content-type: application/json;charset=utf-8');
include '../connectDB.php';

global $conn;
connectDB();
//message(msg_id,content,author,time,msg_state,reply_content)
$content = $_POST['content'];

$ip=$_SERVER["REMOTE_ADDR"];
$author = "游客(".$ip.")";

date_default_timezone_set("Asia/Shanghai");
$time = date("Y-m-d H:i:s"); 

$msg_state = 0;  //need to be checked

$send_message = mysqli_query($conn, "insert into message (content,author,time,msg_state) 
     values('$content','$author','$time','$msg_state')");
if($send_message)
{
    $result = array(
        "code" => 0,
        "msg" => "留言成功，等待审核",
        "res" => array(
            "content" => $content,
            "author" => $author,
            "time" => $time,
            "msg_state" => $msg_state
            )
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else
{
    $result = array(
        "code" => 1,
        "msg" => "留言失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);

?>