<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 13:29
 */
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
$uploader_id = test_input(mysqli_escape_string($conn, $_POST['uploader_id']));
$query_result = mysqli_query($conn, "select * from works 
                                         where ques_id ='$ques_id' AND uploader_id = '$uploader_id';");
if($fetched = mysqli_fetch_array($query_result)){
    //work_id,content,reply,score,attachment,uploader_id,finish
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "work_id" => $fetched['work_id'],
            "reply" => $fetched['reply'],
            "content" => $fetched['content'],
            "score" => $fetched['score'],
            "attachment" => $fetched['attachment'],
            "uploader_id" => $fetched['uploader_id']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>