<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/24
 * Time: 13:40
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
$resource_id = test_input(mysqli_escape_string($conn, $_POST['resource_id']));

$query_result = mysqli_query($conn, "select path FROM resource WHERE resrc_id = '$resource_id';");
if($fetched = mysqli_fetch_array($query_result)){
    $path = $fetched['path'];
    if (unlink($path)) {
        mysqli_query($conn, "delete FROM resource WHERE resrc_id = '$resource_id';");
        $result = array(
            "code" => 0,
            "msg" => "删除成功",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    } else {
        $result = array(
            "code" => -1,
            "msg" => "删除失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
}
else{
    $result = array(
        "code" => -1,
        "msg" => "没有这个资源",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>