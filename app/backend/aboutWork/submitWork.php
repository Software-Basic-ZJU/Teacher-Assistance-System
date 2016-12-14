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
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$ques_id = test_input(mysqli_escape_string($conn, $_POST['ques_id']));
$resrc_id = test_input(mysqli_escape_string($conn, $_POST['resrc_id']));
$resrc_id=$resrc_id?$resrc_id:0;
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$uploader_id = test_input(mysqli_escape_string($conn, $_POST['uploader_id']));

$query_result=mysqli_query($conn,"select work_id from works where ques_id='$ques_id' and uploader_id='$uploader_id'");
if($fetch=mysqli_fetch_array($query_result)){
    $query_result = mysqli_query($conn, "update works set resrc_id='$resrc_id',content='$content'
                                          where ques_id='$ques_id' and uploader_id='$uploader_id'");
}
else{
    $query_result = mysqli_query($conn, "INSERT INTO works
                                     (ques_id,resrc_id,content,uploader_id,finish)
                                      values('$ques_id','$resrc_id','$content','$uploader_id','0');");
}

if($query_result){
    if(!$fetch) {
        $query_result2 = mysqli_query($conn, "update questions set submit_num = submit_num + 1 where ques_id = '$ques_id';");
        if (!$query_result2) {
            $result = array(
                "code" => -1,
                "msg" => "数据库更新失败",
                "res" => array(
                    "token" => $_SESSION['token']
                )
            );
            echo json_encode($result);
            exit;
        }
    }
    $result = array(
        "code" => 0,
        "msg" => "作业提交成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "作业提交失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>