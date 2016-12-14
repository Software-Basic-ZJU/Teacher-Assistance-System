<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 11:27
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
$query_result = mysqli_query($conn, "select * from reply_post 
                                     where post_id ='$post_id';");
if($query_result){
    $repostList = array();
    while($fetched = mysqli_fetch_array($query_result)){
        $repost_id = $fetched['repost_id'];
        //get comment
        $getComment_result = mysqli_query($conn,"select * from comment WHERE type = 1 and target_id = '$repost_id';");
        if($getComment_result){
            $comment = array();
            while($fetched_comment = mysqli_fetch_array($getComment_result)){
                $comment[] = array(
                    "com_id" => $fetched_comment['com_id'],
                    "content" => $fetched_comment['content'],
                    "author_id" => $fetched_comment['author_id'],
                    "author_name" => getAuthorName($conn,$fetched_comment['author_id']),
                    "time" => $fetched_comment['time']
                );
            }
        }
        else{
            $result = array(
                "code" => -1,
                "msg" => "回帖评论查找失败",
                "res" => array(
                    "token" => $_SESSION['token']
                )
            );
            echo json_encode($result);
            exit;
        }
        $repostList[] = array(
            "repost_id" => $fetched['repost_id'],
            "content" => $fetched['content'],
            "author_id" => $fetched['author_id'],
            "author_name" => getAuthorName($conn , $fetched['author_id']),
            "time" => $fetched['time'],
            "commentList" => $comment
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            'repostList' => $repostList,
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