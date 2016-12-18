<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 12:03
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
$repost_id = test_input(mysqli_escape_string($conn, $_POST['repost_id']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$author_id = test_input(mysqli_escape_string($conn, $_POST['author_id']));
$time = date('y-m-d H:i:s',time());

$query_result = mysqli_query($conn, "update reply_post
                                     set content = '$content' , time = '$time'
                                     WHERE repost_id = '$repost_id';");
if($query_result){

    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'repost_id' => $repost_id,
            'time' => $time,
            'content' => $content,
            'author_id' => $author_id,
            'author_name' => getAuthorName($conn,$author_id),
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "修改失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>