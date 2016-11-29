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

// resource_id,uploader_id,name,file
//返回 resource_id,name,time,size,uploader_name,uploader_id
$resource_id = test_input(mysqli_escape_string($conn, $_POST['resource_id']));
$uploader_id = test_input(mysqli_escape_string($conn, $_POST['uploader_id']));
$name = test_input(mysqli_escape_string($conn, $_POST['name']));
$path = test_input(mysqli_escape_string($conn, $_POST['path']));
$time = test_input(mysqli_escape_string($conn, $_POST['time']));
$size = test_input(mysqli_escape_string($conn, $_POST['size']));
if($_SESSION['type'] == 1){
    $user_name = $_SESSION['sname'];
}
elseif ($_SESSION['type'] == 2){
    $user_name = $_SESSION['tname'];
}
//select * from resource JOIN select  where uploader_id = 10001 and type = 0
$getPath_result = mysqli_query($conn, "select path FROM resource WHERE resrc_id = '$resource_id';");
if($fetched = mysqli_fetch_array($getPath_result)){
    $path = $fetched['path'];
    if (unlink($path)) {
        mysqli_query($conn, "update resource 
                             set name = '$name',path = '$path',size = '$size',time = '$time',uploader_id = '$uploader_id'  
                             WHERE resrc_id = '$resource_id';");
        $result = array(
            "code" => 0,
            "msg" => "更新成功",
            "res" => array(//Resource_id,name,time,size,uploader_name,uploader_id
                'resource_id' => $resource_id,
                'name' => $name,
                'time' => $time,
                'size' => $size,
                'uploader_name' => $user_name,
                'uploader_id' => $uploader_id
            )
        );
        echo json_encode($result);
    } else {
        $result = array(
            "code" => 1,
            "msg" => "文件已上传，但旧文件不能删除",
            "res" => array(//Resource_id,name,time,size,uploader_name,uploader_id
                'resource_id' => $resource_id,
                'name' => $name,
                'time' => $time,
                'size' => $size,
                'uploader_name' => $user_name,
                'uploader_id' => $uploader_id
            )
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