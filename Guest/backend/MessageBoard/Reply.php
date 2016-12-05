<?php


if(isset($_POST['replySubmit'])){
    if(isset($_POST['msg_id'])){
        $msg_id=$_POST['msg_id'];
        if(isset($_POST['reply'])){
            $reply=$_POST['reply'];
        }
        else 
        	echo "<script>alert(\"回复失败!\");</script>";
    }
}


include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();
$reply_message = mysqli_query($conn, "UPDATE message SET reply_content = '$reply' WHERE msg_id = '$msg_id'") or die("更新失败".mysql_error());
echo "<script>alert(\"更新成功!\");history.back(-1)</script>";
mysqli_close($conn);
?>