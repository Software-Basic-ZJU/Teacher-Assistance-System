<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/21
 * Time: 16:28
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
$article_id = test_input(mysqli_escape_string($conn, $_POST['article_id']));
$query_result = mysqli_query($conn, "select * from article 
                                         where art_id ='$article_id'");
if($fetched = mysqli_fetch_array($query_result)){
    //Article_id,title,content,author,time
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "article_id" => $fetched['art_id'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "author" => $fetched['author'],
            "time" => $fetched['time'],
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，article_id错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>