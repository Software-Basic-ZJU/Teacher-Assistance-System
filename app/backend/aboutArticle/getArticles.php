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
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
loginCheck($_SERVER['HTTP_X_ACCESS_TOKEN']);
//Get information
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$query_result = mysqli_query($conn, "select * from article
                                     where teacher_id ='$teacher_id';");
if($query_result){
    $articles = array();
    while($fetched = mysqli_fetch_array($query_result)){
        $num = 0;
        $article_id = $fetched['art_id'];
        $get_num = mysqli_query($conn, "select COUNT(com_id) as num from comment
                                     where type = 0 AND target_id ='$article_id';");
        if($fetched_num = mysqli_fetch_array($get_num)){
            $num = $fetched_num['num'];
        }
        $articles[] = array(
            "article_id" => $fetched['art_id'],
            "title" => $fetched['title'],
            "content" => $fetched['content'],
            "author" => $fetched['author'],
            "time" => $fetched['time'],
            "comment_num" => $num
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
		'articles' => $articles,
		"token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "查找失败，teacher_id错误",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>