<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/14
 * Time: 22:51
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
$class_id = test_input(mysqli_escape_string($conn, $_POST['class_id']));

$query_result = mysqli_query($conn, "select * from course_assist.group 
                                         where class_id ='$class_id'");
if($query_result){
    $groupList = array();
    while($fetched = mysqli_fetch_array($query_result)){
        $group_member = array();
        $group_id = $fetched['group_id'];
        $leader_id = $fetched['leader_id'];
        $get_member = mysqli_query($conn,"select name from student WHERE group_id = '$group_id' AND student_id != '$leader_id';");
        while($fetched_name = mysqli_fetch_array($get_member)){
            $group_member[] = array(
                "name" => $fetched_name['name']
            );
        }
        $groupList[] = array(
            "group_id" => $group_id,
            "class_id" => $fetched['class_id'],
            "group_name" => $fetched['group_name'],
            "group_leader" => getAuthorName($conn ,$leader_id),
            "group_member" => $group_member
        );
    }
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            'groupList' => $groupList,
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
mysqli_close($conn);
?>