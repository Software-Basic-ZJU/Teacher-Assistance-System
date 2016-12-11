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
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
$user_type = $_SESSION['type'];
$time = date('y-m-d H:i:s',time());
$path = "upload/". md5($time).$_FILES["file"]["type"];
$size = $_FILES["file"]["size"];
//资源类型：0为教师资源，1为帖子资源，2为跟帖资源
if($_FILES['file']['error'] > 0)
{
    //获取错误信息
    switch($_FILES['file']['error'])
    {
        case 1:
            $info = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。';
            break;
        case 2:
            $info = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。';
            break;
        case 3:
            $info = '文件只有部分被上传。';
            break;
        case 4:
            $info = '没有文件被上传。';
            break;
        case 6:
            $info = '找不到临时文件夹';
            break;
        case 7:
            $info = '文件写入失败。 ';
            break;
    }
    $result = array(
        'code' => 1,
        'msg' => $info,
        'res' => array(
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
    mysqli_close($conn);
    exit;
}
if($user_type == 1){//如果是学生
    if ($size >= 2000000){
        $result = array(
            'code' => 1,
            'msg' => '上传失败,文件大于2M',
            'res' => array(
                'token' => $_SESSION['token']
            )
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
            'size' => $size,
            'token' => $_SESSION['token']
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
        'res' => array(
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
    mysqli_close($conn);
    exit;
}