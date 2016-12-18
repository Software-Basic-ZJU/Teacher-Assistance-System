<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/2
 * Time: 08:14
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
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$section = test_input(mysqli_escape_string($conn, $_POST['section']));
$resrc_id = test_input(mysqli_escape_string($conn, $_POST['resrc_id']));
$time = date('y-m-d H:i:s',time());
$group_id = 0;
if($_SESSION['type']==1){
    $author_id = $_SESSION['student_id'];
    if($section == 2){
        $get_group_result = mysqli_query($conn, "SELECT group_id FROM student WHERE student_id = '$author_id';");
        if($fetched = mysqli_fetch_array($get_group_result)){
            $group_id = $fetched['group_id'];
        }
        else{
            $result = array(
                "code" => 403,
                "msg" => "发帖人并无所在小组",
                "res" => null
            );
            echo json_encode($result);
            exit;
        }
        
    }

}
elseif ($_SESSION['type'] == 2){
    $author_id = $_SESSION['teacher_id'];

}
elseif ($_SESSION['type'] == 3){
    $author_id = $_SESSION['assist_id'];

}
else{
    $result = array(
        "code" => 403,
        "msg" => "发帖人类型错误",
        "res" => null
    );
    echo json_encode($result);
    exit;
}
$query_result = mysqli_query($conn, "INSERT INTO posts 
                                     (title,content,teacher_id,section,author_id,group_id,publish_time,update_time) 
                                      values('$title','$content','$teacher_id','$section','$author_id','$group_id','$time','$time');");
									  
if($query_result){
    $post_id = mysqli_insert_id($conn);

    $getName_result = getAuthorName($conn,$author_id);

    if($resrc_id!=null){
        $updateResource_result = mysqli_query($conn, "update resource
                                         set post_id = '$post_id'
                                         WHERE resrc_id = '$resrc_id';");
        if(!$updateResource_result){
            $result = array(
                "code" => -1,
                "msg" => "附件更新所属帖子失败",
                "res" => array(
                    'token' => $_SESSION['token']
                )
            );
            echo json_encode($result);
            exit;
        }
    }
    $result = array(
        "code" => 0,
        "msg" => "帖子发布成功",
        "res" => array(
            'post_id' => $post_id,
            'title' => $title,
            'content' => $content,
            'author_id' => $author_id,
            'author_name' => getAuthorName($conn,$author_id),
            'publish_time' => $time,
            'update_time' => $time,
            'reply_num' => 0,
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => -1,
        "msg" => "帖子发布失败",
        "res" => array(
            'token' => $_SESSION['token']
        )
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>