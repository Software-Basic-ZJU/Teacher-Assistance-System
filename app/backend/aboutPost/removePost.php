<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/12/12
 * Time: 09:16
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

$query_result = mysqli_query($conn, "delete from posts WHERE post_id = '$post_id';");
if($query_result){
    $delete_result = deleteReplyPost($conn,$post_id);
    $query_result=mysqli_query($conn,"select resrc_id from resource where type = 1 and post_id='$post_id';");
    if($fetch=mysqli_fetch_array($query_result)) {
        $resrc_id = $fetch['resrc_id'];
    }
    else $resrc_id=null;
    
    if($delete_result && $resrc_id){
        $result = array(
            "code" => 0,
            "msg" => "删除成功",
            "res" => array(
                "token" => $_SESSION['token'],
                "resrcId"=>$resrc_id
            )
        );
    }
    else{
        $result = array(
            "code" => 0,
            "msg" => "帖子删除成功,回帖或者资源删除失败",
            "res" => array(
                "token" => $_SESSION['token']
            )
        );
    }
    echo json_encode($result);
    exit;
}
else{
    $result = array(
        "code" => -1,
        "msg" => "帖子删除失败",
        "res" => array(
            "token" => $_SESSION['token']
        )
    );
    echo json_encode($result);
    exit;
}
mysqli_close($conn);
?>