<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/14
 * Time: 22:30
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
require_once '../helpers/async_request.php';
global $conn;
connectDB();
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$leader_id = test_input(mysqli_escape_string($conn, $_POST['leader_id']));
$group_id = test_input(mysqli_escape_string($conn, $_POST['group_id']));
if($_SESSION['type'] ==1){
    if($_SESSION['student_id']!=$leader_id){
        $result = array(
            "code" => 403,
            "msg" => "无效用户尝试删除",
            "res" => null
        );
        echo json_encode($result);
        exit;
    }
    $check = mysqli_query($conn,"select * from course_assist.group WHERE group_id = '$group_id';");
    if($fetched = mysqli_fetch_array($check)){
        if($fetched['leader_id'] != $leader_id){
            $result = array(
                "code" => 403,
                "msg" => "无效用户尝试删除",
                "res" => null
            );
            echo json_encode($result);
            exit;
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "无此小组",
            "res" => null
        );
        echo json_encode($result);
        exit;
    }
}

/*
//      TODO:异步删除七牛云上的文件
$query_resrc=mysqli_query($conn,"select resrc_id from resource left join posts on resource.post_id=posts.post_id where posts.group_id='$group_id';");
while($fetched=mysqli_fetch_array($query_resrc)){
    $resrcId=$fetched['resrc_id'];
    $postData=array(
        'resource_id'=>$resrcId
    );
    async_request("https://".$_SERVER['HTTP_HOST']."/app/backend/aboutResource/removeResource.php",$postData);
}
*/


$update = mysqli_query($conn,"update student set group_id = -1 WHERE group_id = '$group_id';");
$query_result = mysqli_query($conn, "delete t1,t2,t3 from course_assist.group as t1 left join posts as t2
                                    on t1.group_id=t2.group_id left join resource as t3 on t2.post_id=t3.post_id WHERE t1.group_id = '$group_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "删除成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
else{
    $result = array(
        "code" => -1,
        "msg" => "删除失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
mysqli_close($conn);
?>