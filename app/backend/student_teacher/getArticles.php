<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/21
 * Time: 16:21
 */
header('Content-type: application/json');
session_start();
// Connect database
include '_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_POST['token']);
//Get information
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$query_result = mysqli_query($conn, "select * from article 
                                         where teacher_id ='$teacher_id'");
if($fetched = mysqli_fetch_array($query_result)){
    $articles = array();
    do{ //Articles[String](title,content,author,time)
        $articles[] = array(
            "article_id" => $fetched['article_id'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "author" => $fetched['author'],
            "time" => $fetched['time']
        );
    }while($fetched = mysqli_fetch_array($query_result));
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => $articles
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "查找失败，teacher_id错误",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>