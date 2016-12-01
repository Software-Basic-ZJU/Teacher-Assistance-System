<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 13:06
 */
//ques_id,Content,attachment,uploader_id
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_POST['token']);
//Get information
$ques_id = test_input(mysqli_escape_string($conn, $_POST['ques_id']));
$attachment = test_input(mysqli_escape_string($conn, $_POST['attachment']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$uploader_id = test_input(mysqli_escape_string($conn, $_POST['uploader_id']));
$type = test_input(mysqli_escape_string($conn, $_POST['type']));
$query_result = mysqli_query($conn, "INSERT INTO works
                                     (ques_id,attachment,content,uploader_id,type)
                                      values('$ques_id','$attachment','$content','$uploader_id','$type');");
if($query_result){
    $query_result2 = mysqli_query($conn, "update questions set submit_num = submit_num + 1 where ques_id = '$ques_id';");
    if($query_result2){
        $result = array(
            "code" => 0,
            "msg" => "作业提交成功",
            "res" => null
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => 2,
            "msg" => "作业提交成功,但是数据库已交数目并未更新",
            "res" => null
        );
        echo json_encode($result);
    }
}
else{
    $result = array(
        "code" => 1,
        "msg" => "作业提交失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>