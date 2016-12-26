<?php
/**
 * Created by PhpStorm.
 * User: asus-pc
 * Date: 2016/12/26
 * Time: 21:54
 */

require_once '../qiniu/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

$accessKey='ZIdM50EJH3PqLE1FMeslyAyAf3BNC2nq3VpC3TFp';
$secretKey='RIPOY78DZ-EcwVahqBQLMPXd6crMEK5i5iKTXZxd';

$auth=new Auth($accessKey,$secretKey);      //构建鉴权对象
$bucket='course-assist';                    //要上传的空间

$token=$auth->uploadToken($bucket);         // 生成Token
function uploadFile($file){
    $user_type = $_SESSION['type'];
    $time = date('y-m-d H:i:s',time());
    $fileName=explode(".",$file['name']);   //分割出文件名和后缀名
    $path = substr(md5($time.$fileName[0]),8,24) . (count($fileName)>1?("." . $fileName[count($fileName)-1]):".txt");
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
//    chmod($file["tmp_name"],755);

    $filePath=$file["tmp_name"];    //要上传文件的本地路径
    $key=$path;                     //上传到七牛云保存的文件名

    $uploadMgr=new UploadManager(); //初始化并进行文件上传
    global $token;
    list($ret,$err)=$uploadMgr->putFile($token,$key,$filePath);
    if($err !=null){
        $result = array(
            'code' => -1,
            'msg' => '上传失败',
            'res' => null
        );
        return $result;
    }
    else{
        $result = array(
            'code' => 0,
            'msg' => '上传成功',
            'res' => array(
                'path' => $ret['key'],
                'time' => $time,
                'size' => $size,
                'name' => test_input($file["name"])
            )
        );
        return $result;
    }

//    if(move_uploaded_file($file["tmp_name"], $path)){
//        $result = array(
//            'code' => 0,
//            'msg' => '上传成功',
//            'res' => array(
//                'path' => $path,
//                'time' => $time,
//                'size' => $size,
//                'name' => test_input($file["name"])
//            )
//        );
//        return $result;
//    }
//    else{
//        $result = array(
//            'code' => -1,
//            'msg' => '上传失败',
//            'res' => null
//        );
//        return $result;
//    }

}
