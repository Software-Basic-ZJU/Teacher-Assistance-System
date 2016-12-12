<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 09:16
 */
header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$post_id = test_input(mysqli_escape_string($conn, $_POST['post_id']));
if($_SESSION['type']!=2){
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试删除",
        "res" => null
    );
    echo json_encode($result);
    exit;
}

$query_result = mysqli_query($conn, "delete from posts WHERE post_id = '$post_id';");
if($query_result){
    $delete_result = deleteReplyPost($conn,$post_id);
    $deleteResource_result = deleteResource($conn,$post_id);
    if($delete_result && $deleteResource_result){
        $result = array(
            "code" => 0,
            "msg" => "删除成功",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
    }
    else{
        $result = array(
            "code" => 0,
            "msg" => "帖子删除成功,回帖或者资源删除失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
    }
    echo json_encode($result);
    exit;
}
else{
    $result = array(
        "code" => -1,
        "msg" => "帖子删除失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
mysqli_close($conn);
?>