<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/20
 * Time: 16:40
 */
date_default_timezone_set('Asia/Shanghai');
header('Content-type: application/json;charset=utf-8');

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
    chmod($file["tmp_name"],0755);

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
//删除特定文章或者回帖的所有评论,传入repost_id或者article_id
function deleteComment($conn,$target_id){
    $query_result = mysqli_query($conn, "delete from comment WHERE target_id = '$target_id';");
    if($query_result) return 1;
    else return 0;
}
//删除特定帖子的所有回帖及回帖下的评论
function deleteReplyPost($conn,$post_id){
    $query_repost = mysqli_query($conn,"select repost_id from reply_post WHERE post_id = '$post_id';");
    if($query_repost){
        while($fetched_repost = mysqli_fetch_array($query_repost)){
            $repost_id = $fetched_repost['repost_id'];
            deleteComment($conn,$repost_id);
        }
    }
    $query_result = mysqli_query($conn, "delete from reply_post WHERE post_id = '$post_id';");
    if($query_result) return 1;
    else return 0;
}
function deleteResource($conn,$post_id){
    $query_result = mysqli_query($conn, "delete from resource WHERE type = 1 AND post_id = '$post_id';");
    if($query_result) return 1;
    else return 0;
}
function getAuthorName($conn,$author_id){
//    $check = mysqli_query($conn,"select * from admin WHERE admin_id = '$author_id'");
    if($author_id == "administrator"){
        return "administrator";
    }
    $getName_result = mysqli_query($conn,"select * 
                    from (select student_id as id, name as name from student 
                          UNION 
                          select teacher_id as id ,name as name from teacher
                          UNION 
                          select assist_id as id ,name as name from assist) as temp
                    WHERE temp.id = '$author_id';");
    if($fetched_name = mysqli_fetch_array($getName_result)){
        return $fetched_name['name'];
    }
    else{
        $result = array(
            "code" => 403,
            "msg" => "发布者身份非法",
            "res" => null
        );
        echo json_encode($result);
        exit;
    }
}
function sendCodesEmail($email, $codes){
    /**
     * 注：发送邮件的时候遇到了失败的问题，请从以下几点排查：
     * 1. 用户名和密码是否正确；
     * 2. 检查邮箱设置是否启用了smtp服务；
     */
    require_once "email.class.php";
//******************** 配置变量 ********************************
    $smtpserver = "smtp.163.com";//SMTP服务器
    $smtpserverport =25;//SMTP服务器端口
    $smtpusermail = "zjdxjw12@163.com";//SMTP服务器的用户邮箱
    //Connect database
    global $conn;
    connectDB();
    $query = mysqli_query($conn,
        "select name from student where email='$email' limit 1");
    $user_name = mysqli_fetch_array($query)['name'];
    if(!$user_name){
        return 1;   //邮件发送失败,邮箱地址不在用户列表
    }
    $smtpemailto = $email;//发送给谁
    $fromName = '浙江大学课程辅助系统';
    $smtpuser = "zjdxjw12@163.com";//SMTP服务器的用户帐号
    $smtppass = "zjdx123";//密码，或者授权码
    $mailtitle = "【浙江大学课程辅助系统】忘记密码";//邮件主题
    $mailcontent = "尊敬的用户 ".$user_name.":<br/>"."您正在申请重置密码，您的验证码为：<br/>".$codes;//邮件内容
    $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 创建对象 ****************************
    $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
    //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $smtp->debug = false;//是否显示发送的调试信息，默认不发送
    $state = $smtp->sendmail($smtpemailto, $smtpusermail, $fromName,
        $mailtitle, $mailcontent, $mailtype);
    if($state=="")
        $error = -1;
    else
        $error = 0;
    return $error;
}
function changePassword($conn,$id,$newPassword,$type){
    switch ($type){
        case 1:
        {
            $query_result = mysqli_query($conn, "select * from student 
                                         where student_id ='$id';");
            if($fetched = mysqli_fetch_array($query_result)){
                if($fetched['check_code'] == 1){
                    $update_result = mysqli_query($conn, "update student
                                     set password = '$newPassword', check_code = -1
                                     WHERE student_id = '$id';");
                    if($update_result){
                        return 0;//修改成功
                    }
                    else{
                        return -1;//修改失败
                    }
                }
                else{
                    return -2;//用户还未通过验证
                }
            }
            else{
                return -3;//无此人
            }
        }
        case 2:
        {
            $query_result = mysqli_query($conn, "select * from teacher 
                                         where teacher_id ='$id';");
            if($fetched = mysqli_fetch_array($query_result)){
                if($fetched['check_code'] == 1){
                    $update_result = mysqli_query($conn, "update teacher
                                     set password = '$newPassword', check_code = -1
                                     WHERE teacher_id = '$id';");
                    if($update_result){
                        return 0;//修改成功
                    }
                    else{
                        return -1;//修改失败
                    }
                }
                else{
                    return -2;//用户还未通过验证
                }
            }
            else{
                return -3;//无此人
            }
        }
    }
}
?>
