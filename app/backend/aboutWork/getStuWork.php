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
//loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$ques_id = test_input(mysqli_escape_string($conn, $_POST['ques_id']));
$uploader_id = test_input(mysqli_escape_string($conn, $_POST['uploader_id']));
$query_result = mysqli_query($conn, "select * from works join (select ques_id, questions.title as ques_title,homework.title as hw_title
                            from questions join homework on questions.hw_id=homework.hw_id ) as temp 
                            on works.ques_id=temp.ques_id where works.ques_id ='$ques_id' AND works.uploader_id = '$uploader_id';");
if($query_result){
    $fetched = mysqli_fetch_array($query_result);
    $resrc_id=$fetched['resrc_id'];
    $query_resrc=mysqli_query($conn,"select * from resource where resrc_Id='$resrc_id';");
    $resrcFetch=mysqli_fetch_array($query_resrc);
    //work_id,content,reply,score,attachment,uploader_id,finish
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "ques_title"=>$fetched['ques_title'],
            "hw_title"=>$fetched['hw_title'],
            "work_id" => $fetched['work_id'],
            "reply" => $fetched['reply'],
            "content" => $fetched['content'],
            "score" => $fetched['score'],
            "resrc_id" => $resrcFetch['resrc_id'],
            "resrc_name"=>$resrcFetch['name'],
            "path"=>"http://".$_SERVER['HTTP_HOST']."/backend/aboutResource/".$resrcFetch['path'],
            "uploader_id" => $fetched['uploader_id'],
            "finish"=>$fetched['finish'],
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>