<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/24
 * Time: 15:10
 */
header('Content-type: application/json');
session_start();

//Connect database
global $conn;
include('../login/_include.php');
connectDB();

//Verify token
loginCheck($_POST['token']);
$user_type = $_SESSION['type'];
$time = date('y-m-d h:i:s',time());
$path = "upload/". md5($time).$_FILES["file"]["type"];
$size = $_FILES["file"]["size"];
//资源类型：0为教师资源，1为帖子资源，2为跟帖资源
if($user_type == 1){//如果是学生
    if ($size >= 2000000){
        $result = array(
            'code' => 1,
            'msg' => '上传失败,文件大于2M',
            'res' => null
        );
        echo json_encode($result);
        mysqli_close($conn);
        exit;
    }
}
if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
    $result = array(
        'code' => 0,
        'msg' => '上传成功',
        'res' => array(
            'path' => $path,
            'time' => $time,
            'size' => $size
        )
    );
    echo json_encode($result);
    mysqli_close($conn);
    exit;
}
else{
    $result = array(
        'code' => 1,
        'msg' => '上传失败',
        'res' => null
    );
    echo json_encode($result);
    mysqli_close($conn);
    exit;
}