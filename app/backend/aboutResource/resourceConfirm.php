<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/6
 * Time: 13:36
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
$name = test_input(mysqli_escape_string($conn, $_POST['name']));

/*$old_resource_id = test_input(mysqli_escape_string($conn, $_POST['old_resource_id']));
if($old_resource_id != null){
    $getPath_result = mysqli_query($conn, "select path FROM resource WHERE resrc_id = '$old_resource_id';");
    if($fetched_path = mysqli_fetch_array($getPath_result)){
        $path = $fetched_path['path'];
        if (unlink($path)) {
            mysqli_query($conn, "delete FROM resource WHERE resrc_id = '$old_resource_id';");
        } else {
            $result = array(
                "code" => -1,
                "msg" => "删除旧文件失败",
                "res" => null
            );
            echo json_encode($result);
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "没有这个资源",
            "res" => null
        );
        echo json_encode($result);
    }
}*/

$query_result = mysqli_query($conn, "update resource
                                     set name = '$name'
                                     WHERE resrc_id = '$resource_id';");
if($query_result){
    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'name' => $name
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "修改失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>