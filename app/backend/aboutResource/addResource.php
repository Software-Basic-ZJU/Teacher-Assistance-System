<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/24
 * Time: 13:39
 */
header('Content-type: application/json');
session_start();

//Connect database
global $conn;
include('../login/_include.php');
connectDB();

//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$upload_result = uploadFile($_SERVER['HTTP_X_ACCESS_TOKEN'],$_FILES['file']);
if($upload_result['code']!=0){
    echo json_encode($upload_result);
    exit;
}
else{
    $name = $upload_result['res']['name'];
    $time = $upload_result['res']['time'];
    $size = $upload_result['res']['size'];
    $path = $upload_result['res']['path'];
}
$uploader_id = $_POST['uploader_id'];
$type = $_POST['type'];
$post_id = null;
$user_type = $_SESSION['type'];
//Add resource
$add_result = mysqli_query($conn,
    "insert into resource (name,path,size,time,type,post_id,uploader_id) 
     values('$name','$path','$size','$time','$type','$post_id','$uploader_id')");

if($add_result){
    $resource_id = mysqli_insert_id($conn);
    if($user_type == 1){
        $user_name = $_SESSION['sname'];
    }
    elseif ($user_type == 2){
        $user_name = $_SESSION['tname'];
    }
    $result = array(
        'code' => 0,
        'msg' => '添加成功',
        'res' => array(//Resource_id,name,time,size,uploader_name,uploader_id
            'resource_id' => $resource_id,
            'name' => $name,
            'time' => $time,
            'size' => $size,
            'path' => $path,
            'uploader_name' => $user_name,
            'uploader_id' => $uploader_id
        )
    );
    echo json_encode($result);
} else{
        $result = array(
            'code' => -1,
            'msg' => '添加失败,数据库错误',
            'res' => null
        );
        echo json_encode($result);
    }

mysqli_close($conn);
?>