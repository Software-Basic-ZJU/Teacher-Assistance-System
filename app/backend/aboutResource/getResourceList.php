<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/24
 * Time: 13:39
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
//select * from resource JOIN select  where uploader_id = 10001 and type = 0
$query_result = mysqli_query($conn, "select * ,teacher.name as uploader_name,resource.name as resource_name 
                 from resource join teacher on uploader_id = teacher_id and type = 0 and uploader_id = '$teacher_id';");
if($query_result){
    $resourceList = array();
    while($fetched = mysqli_fetch_array($query_result)){
        $resourceList[] = array(
            "resource_id" => $fetched['resrc_id'],
            "name" => $fetched['resource_name'],
            "path" =>"http://".$_SERVER['HTTP_HOST']."/backend/aboutResource/". $fetched['path'],
            "upload_time" => $fetched['time'],
            "uploader_name" => $fetched['uploader_name'],
            "size" => $fetched['size']
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "token" => $_SESSION['token'],
            "resource_list" => $resourceList
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，teacher_id错误",
        "res" => array(
            "token"=>$_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>