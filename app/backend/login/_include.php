<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/20
 * Time: 16:40
 */
date_default_timezone_set('Asia/Shanghai');
header('Content-type: application/json;charset=utf-8');
session_start();

include 'loginCheck.php';

function test_input($data) {
    $data = inject_prevent($data);
    $data = trim($data);//去除用户输入数据中不必要的字符（多余的空格、制表符、换行）
    $data = stripslashes($data);//删除用户输入数据中的反斜杠（\）
    $data = htmlspecialchars($data);//把特殊字符转换为 HTML 实体
    return $data;
}

function inject_prevent($Sql_Str) {//自动过滤Sql的注入语句。
    $check=preg_match('/select|insert|update|delete|\'|\\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i',$Sql_Str);
    if ($check) {
        $Sql_Str = strtr($Sql_Str,array("select"=>" ", 'insert'=>' ', 'update'=>' ', 'delete'=>' '));
    }
    return $Sql_Str;
}
function uploadFile($file){
    $user_type = $_SESSION['type'];
    $time = date('y-m-d H:i:s',time());
    $fileName=explode(".",$file['name']);   //分割出文件名和后缀名
    $path = "upload/" . substr(md5($time.$fileName[0]),8,24) . (count($fileName)>1?("." . $fileName[count($fileName)-1]):".txt");
    $size = $file["size"];
    //资源类型：0为教师资源，1为帖子资源，2为跟帖资源
    if($file['error'] > 0)
    {
        //获取错误信息
        switch($file['error'])
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
            'code' => -1,
            'msg' => $info,
            'res' => null
        );
        return $result;
    }
    if($user_type == 1){//如果是学生
        if ($size >= 2*1024*1024){
            $result = array(
                'code' => -1,
                'msg' => '上传失败,文件大于2M',
                'res' => null
            );
            return $result;
        }
    }

    if(move_uploaded_file($file["tmp_name"], $path)){
        $result = array(
            'code' => 0,
            'msg' => '上传成功',
            'res' => array(
                'path' => $path,
                'time' => $time,
                'size' => $size,
                'name' => test_input($file["name"])
            )
        );
        return $result;
    }
    else{
        $result = array(
            'code' => -1,
            'msg' => '上传失败',
            'res' => null
        );
        return $result;
    }
}
?>
