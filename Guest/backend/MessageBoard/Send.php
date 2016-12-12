<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();
//message(msg_id,content,author,time,msg_state,reply_content)
$content = $_POST['message'];

$author = $_POST['author'];

$time = $_POST['time']; 

$msg_state = 0;  //need to be checked

$send_message = mysqli_query($conn, "insert into message (content,author,time,msg_state) 
     values('$content','$author','$time','$msg_state')");
if($send_message)
    echo "<script>alert(\"留言成功，请等待审核!\");history.back(-1)</script>";
else
    echo "<script>alert(\"留言失败!\");history.back(-1)</script>";
mysqli_close($conn);

?>