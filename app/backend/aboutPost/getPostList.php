<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 22:19
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
$section = test_input(mysqli_escape_string($conn, $_POST['section']));//所在版块：0为教师答疑区，1为公共讨论区，2为小组讨论区
$teacher_id = test_input(mysqli_escape_string($conn, $_POST['teacher_id']));
$group_id = test_input(mysqli_escape_string($conn, $_POST['group_id']));
if($section == 2){
    if($_SESSION["type"]==1 && $_SESSION["group_id"]!=$group_id){
        $result = array(
            "code" => 403,
            "msg" => "访问者身份非法",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
    $group_query=mysqli_query($conn,"select group_name from course_assist.group where group_id='$group_id';");
    if($groupFetch=mysqli_fetch_array($group_query)){
        $groupName=$groupFetch['group_name'];
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "没有该小组",
            "res" => array()
        );
        echo json_encode($result);
        exit;
    }
    $query_result = mysqli_query($conn, "select * from posts LEFT JOIN 
                            (select COUNT(DISTINCT repost_id) as reply_num ,post_id as pid from reply_post group by post_id) as temp
                             ON temp.pid = posts.post_id WHERE section = '$section' 
                             AND teacher_id = '$teacher_id' AND posts.group_id = '$group_id';");
    if($query_result){//当语句正确的时候
        $postList = array();
        while($fetched = mysqli_fetch_array($query_result)){//能查到数据的时候
            $postList[] = array(
                "post_id" => $fetched['post_id'],
                "title" => $fetched['title'],
                "author_id" => $fetched['author_id'],
                "author_name" => getAuthorName($conn,$fetched['author_id']),
                "publish_time" => $fetched['publish_time'],
                "update_time" => $fetched['update_time'],
                "reply_num" => $fetched['reply_num']?$fetched['reply_num']:0,
            );
        }
        $result = array(
            "code" => 0,
            "msg" => "查找成功",
            "res" => array(
                'postList' => $postList,
                'groupName'=>$groupName,
                'token' => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "查找失败，错误",
            "res" => array(
                'token' => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    mysqli_close($conn);
}
else{
    $query_result = mysqli_query($conn, "select * from posts LEFT JOIN (select COUNT(DISTINCT repost_id) as reply_num ,post_id as pid from reply_post GROUP BY post_id) as temp ON temp.pid = posts.post_id WHERE section = '$section' AND teacher_id = '$teacher_id';");
    if($query_result){
        $postList = array();        //post_id,title,content,author_id,author_name,publish_time,update_time,reply_num,attachment[String](resource_id,name,path,size)
        while($fetched = mysqli_fetch_array($query_result)){
            $postList[] = array(
                "post_id" => $fetched['post_id'],
                "title" => $fetched['title'],
                "content" => htmlspecialchars_decode($fetched['content']),
                "author_id" => $fetched['author_id'],
                "author_name" => getAuthorName($conn,$fetched['author_id']),
                "publish_time" => $fetched['publish_time'],
                "update_time" => $fetched['update_time'],
                "reply_num" => $fetched['reply_num']?$fetched['reply_num']:0,
            );
        }

        $result = array(
            "code" => 0,
            "msg" => "查找成功",
            "res" => array(
                'postList' => $postList,
                'token' => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "查找失败，错误",
            "res" => array(
                'token' => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    mysqli_close($conn);
}

?>