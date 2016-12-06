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
loginCheck($_POST['token']);
//Get information
//Title,content,teacher_id,section,attachment[]
$title = test_input(mysqli_escape_string($conn, $_POST['title']));
$content = test_input(mysqli_escape_string($conn, $_POST['content']));
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$section = test_input(mysqli_escape_string($conn, $_POST['section']));
$time = date('y-m-d H:i:s',time());
$group_id = null;
if($_SESSION['type']==1){
    $author_id = $_SESSION['student_id'];
    if($section == 2){
        $get_group_result = mysqli_query($conn, "SELECT group_id FROM student WHERE student_id = '$author_id';");
        if($fetched = mysqli_fetch_array($get_group_result)){
            $group_id = $fetched['group_id'];
        }
        else{
            $result = array(
                "code" => 2,
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
$query_result = mysqli_query($conn, "INSERT INTO posts 
                                     (title,content,teacher_id,section,author_id,group_id,publish_time,publish_time) 
                                      values('$title','$content','$teacher_id','$section','$author_id','$group_id','$time','$time');");
if($query_result){
    $getName_result = mysqli_query($conn, "select * from student WHERE student_id = '$author_id';");
    if($fetched_name = mysqli_fetch_array($getName_result)){
        $author_name = $fetched_name['name'];
    }
    else{
        $getName_result = mysqli_query($conn, "select * from teacher WHERE teacher_id = '$author_id';");
        if($fetched_name = mysqli_fetch_array($getName_result)){
            $author_name = $fetched_name['name'];
        }
        else{
            $result = array(
                "code" => 3,
                "msg" => "无此上传人",
                "res" => null
            );
            echo json_encode($result);
            exit;
        }
    }

    $getResource_result = mysqli_query($conn, "select * from resource WHERE post_id = '$post_id' AND type = 1;");
    if($fetched_resource = mysqli_fetch_array($getResource_result)){
        $attachment = array();
        do{
            $attachment[] = array(
                "resrc_id" => $fetched_resource['resrc_id'],
                "name" => $fetched_resource['name'],
                "path" => $fetched_resource['path'],
                "size" => $fetched_resource['size']
            );
        }while($fetched_resource = mysqli_fetch_array($getResource_result));
    }
    else{
        $attachment = null;
    }


    $result = array(
        "code" => 0,
        "msg" => "帖子发布成功",
        "res" => array(
            'post_id' => mysqli_insert_id($conn),
            'title' => $title,
            'content' => $content,
            'author_id' => $author_id,
            'author_name' => $author_name,
            'publish_time' => $time,
            'update_time' => $time,
            'reply_num' => 0,
            'attachment' => $attachment
        )
    );
    echo json_encode($result);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "通知发布失败",
        "res" => null
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>