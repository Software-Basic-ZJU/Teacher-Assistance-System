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
loginCheck($_POST['token']);
//Get information
$resource_id = test_input(mysqli_escape_string($conn, $_POST['resource_id']));

//select * from resource JOIN select  where uploader_id = 10001 and type = 0
$query_result = mysqli_query($conn, "select path FROM resource WHERE resrc_id = '$resource_id';");
if($fetched = mysqli_fetch_array($query_result)){
    $path = $fetched['path'];
    if (unlink($path)) {
        mysqli_query($conn, "delete FROM resource WHERE resrc_id = '$resource_id';");
        $result = array(
            "code" => 0,
            "msg" => "删除成功",
            "res" => null
        );
        echo json_encode($result);
    } else {
        $result = array(
            "code" => 1,
            "msg" => "删除失败",
            "res" => null
        );
        echo json_encode($result);
    }
}
else{
    $result = array(
        "code" => 2,
        "msg" => "没有这个资源",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>