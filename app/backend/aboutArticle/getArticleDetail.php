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
    $query_comment = mysqli_query($conn,"select * from comment JOIN (select student_id as id, name as name from student 
                          UNION 
                          select teacher_id as id ,name as name from teacher) as temp
         WHERE comment.author_id = temp.id AND comment.target_id = '$article_id' AND type = 0;");

    if($query_comment){
        $comment = array();
        while($fetched_comment = mysqli_fetch_array($query_comment)){
            $comment[] = array(
                "com_id" => $fetched_comment['com_id'],
                "content" => $fetched_comment['content'],
                "time" => $fetched_comment['time'],
                "author_id" => $fetched_comment['author_id'],
                "name" => $fetched_comment['name']
            );
        }
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "评论查找失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
        exit;
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "article_id" => $fetched['art_id'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "author" => $fetched['author'],
            "time" => $fetched['time'],
            "comment" => $comment,
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