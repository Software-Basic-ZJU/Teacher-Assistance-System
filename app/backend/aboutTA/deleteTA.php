<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/15
 * Time: 12:01
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
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$assist_id = test_input(mysqli_escape_string($conn, $_POST['assist_id']));
if($_SESSION[$teacher_id]!=$teacher_id){
    $result = array(
        "code" => 403,
        "msg" => "无效用户尝试删除",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "update class_teacher set assist_id = -1 WHERE assist_id = '$assist_id' AND teacher_id = '$teacher_id';");
if($query_result){
    $query_result2 = mysqli_query($conn, "delete FROM assists WHERE assist_id = '$assist_id';");
    if($query_result2){
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
            "code" => 0,
            "msg" => "联系表删除成功,助教表删除失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
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