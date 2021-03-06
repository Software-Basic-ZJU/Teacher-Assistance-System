<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/28
 * Time: 09:10
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
$article_id = test_input(mysqli_escape_string($conn, $_POST['article_id']));
if($_SESSION['type']!=2){
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试删除",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "delete from article WHERE art_id = '$article_id';");
if($query_result){
    if(!deleteComment($conn,$article_id)){
        $result = array(
            "code" => -1,
            "msg" => "删除评论失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
    $result = array(
        "code" => 0,
        "msg" => "删除成功",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
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
}
mysqli_close($conn);
?>