<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/1
 * Time: 20:53
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
$group_id=test_input(mysqli_escape_string($conn, $_POST['group_id']));
if($_SESSION['type']==1){
    if($group_id>0){
        $query_result = mysqli_query($conn, "select * from 
        (select section,count(post_id) as total_num,COUNT( CASE WHEN to_days(publish_time) = to_days(now()) THEN 1 ELSE NULL END ) as today_num 
        from posts 
        where teacher_id = '$teacher_id' and section != 2 
        group by section) as temp1 
        union 
        (select section,count(post_id) as total_num,COUNT( CASE WHEN to_days(publish_time) = to_days(now()) THEN 1 ELSE NULL END ) as today_num 
        from posts 
        where teacher_id = '$teacher_id' and section = 2 and group_id = '$group_id');");
    }
    else{
        $query_result = mysqli_query($conn, "select section,count(post_id) as total_num,COUNT( CASE WHEN to_days(publish_time) = to_days(now()) THEN 1 ELSE NULL END ) as today_num 
        from posts 
        where teacher_id = '$teacher_id' and section != 2 
        group by section;");
    }
    if($query_result){
        $sectionList = array();
        while($fetched = mysqli_fetch_array($query_result)){
            $sectionList[] = array(
                "section" => $fetched['section'],
                "total_num" => $fetched['total_num'],
                "today_num" => $fetched['today_num']
            );
        }
        $result = array(
            "code" => 0,
            "msg" => "查找成功",
            "res" => array(
                'sectionList' => $sectionList,
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "查找失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
}
else{
    $query_result = mysqli_query($conn, "select section,count(post_id) as total_num,COUNT( CASE WHEN to_days(publish_time) = to_days(now()) THEN 1 ELSE NULL END ) as today_num from posts where teacher_id = '$teacher_id' group by section;");
    if($query_result){
        $sectionList = array();
        while($fetched = mysqli_fetch_array($query_result)){
            $sectionList[] = array(
                "section" => $fetched['section'],
                "total_num" => $fetched['total_num'],
                "today_num" => $fetched['today_num']
            );
        }
        $result = array(
            "code" => 0,
            "msg" => "查找成功",
            "res" => array(
                'sectionList' => $sectionList,
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
    else{
        $result = array(
            "code" => -1,
            "msg" => "查找失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
        echo json_encode($result);
    }
}

mysqli_close($conn);
?>