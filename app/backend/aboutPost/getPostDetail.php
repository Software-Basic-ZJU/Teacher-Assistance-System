<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/13
 * Time: 11:36
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
$post_id = test_input(mysqli_escape_string($conn, $_POST['post_id']));
$query_result = mysqli_query($conn, "select * from posts 
                                         where post_id ='$post_id'");
if($fetched = mysqli_fetch_array($query_result)){
    $query_resource = mysqli_query($conn,"select * from resource where type = 1 AND post_id = '$post_id';");
    $resource = array();
    if($fetched2 = mysqli_fetch_array($query_resource)){
        $resource = array(
            "resrc_id" => $fetched2['resrc_id'],
            "name" => $fetched2['name'],
            "path" => "http://".$_SERVER['HTTP_HOST']."/backend/aboutResource/".$fetched2['path'],
            "size" => $fetched2['size'],
            "time" => $fetched2['time'],
            "type" => $fetched2['type'],
            "post_id" => $fetched2['post_id'],
            "uploader_id" => $fetched2['uploader_id']
        );
    }

    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "post_id" => $fetched['post_id'],
            "teacher_id" => $fetched['teacher_id'],
            "section" => $fetched['section'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "author_id" => $fetched['author_id'],
            "author_name" => getAuthorName($conn,$fetched['author_id']),
            "group_id" => $fetched['group_id'],
            "publish_time" => $fetched['publish_time'],
            "update_time" => $fetched['update_time'],
            "resource" => $resource,
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，post_id错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>