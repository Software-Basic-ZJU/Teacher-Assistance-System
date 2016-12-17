<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 08:31
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
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$time = date('Y-m-d H:i:s',time());
$query_result = mysqli_query($conn, "update posts
                                     set title = '$title', content = '$content',update_time = '$time'
                                     WHERE post_id = '$post_id';");
if($query_result){
//    $query_result2 = mysqli_query($conn,"select author_id,publish_time,name
//                                  from posts JOIN ((select student_id as id, name as name from student
//                                                    UNION
//                                                    select teacher_id as id ,name as name from teacher) as temp)
//                                  WHERE post_id = '$post_id' AND temp.id = posts.author_id;");
//    $fetched = mysqli_fetch_array($query_result2);
    

    $result = array(
        "code" => 0,
        "msg" => "修改成功",
        "res" => array(
            'post_id' => $post_id,
            'title' => $title,
            'content' => $content,
//            'author_id' => $fetched['author_id'],
//            'author_name' => $fetched['name'],
//            'publish_time' => $fetched['publish_time'],
            'update_time' => $time,
            'token' => $_SESSION['token']
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