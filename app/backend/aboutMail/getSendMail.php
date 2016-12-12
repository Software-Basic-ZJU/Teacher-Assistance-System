<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 16:01
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
$src_id = test_input(mysqli_escape_string($conn, $_POST['src_id']));
//mailList[string](mail_id,title,content,time,src_id,src_name,dest_id,is_read)
$query_result = mysqli_query($conn, "select * from mail 
                                         where src_id ='$src_id' AND (flag = 1 OR flag = 0) ;");
if($query_result){
    $mailList = array();
    while($fetched = mysqli_fetch_array($query_result)){
        $mailList[] = array(
            "mail_id" => $fetched['mail_id'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "time" => $fetched['time'],
            "src_id" => $src_id,
            "dest_id" => $fetched['dest_id'],
            "dest_name" => getAuthorName($conn,$fetched['dest_id'])
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            'mails' => $mailList,
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "发件箱打开失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>