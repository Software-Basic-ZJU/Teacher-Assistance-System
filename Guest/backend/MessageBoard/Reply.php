<?php

if(isset($_POST['commentSubmit'])){
    if(isset($_POST['msg_id'])){
        $msg_id=$_POST['msg_id'];
        if(isset($_POST['comment'])){
            $comment=$_POST['comment'];
        }
        else echo "<script>alert(\"回复失败!\");</script>";
    }
}
echo $msg_id;

include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();
$reply_message = mysqli_query($conn, "UPDATE message SET reply_content = '$comment' WHERE msg_id = '$msg_id'") or die("更新失败".mysql_error());
mysqli_close($conn);
?>