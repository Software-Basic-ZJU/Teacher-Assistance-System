<?php
/**
 * Created by PhpStorm.
 * User: Wu
 * Date: 2016/11/24
 * Time: 13:40
 */
header('Content-type: application/json');
session_start();

// 用于异步执行
ignore_user_abort(TRUE);    //如果客户端断开连接，不会引起脚本abort
set_time_limit(0);          //取消脚本执行延时上限

// Connect database
include '../login/_include.php';
require_once '../qiniu/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
global $conn;
connectDB();

//Get information
$resource_id = test_input(mysqli_escape_string($conn, $_POST['resource_id']));

$query_result = mysqli_query($conn, "select path FROM resource WHERE resrc_id = '$resource_id';");
if($fetched = mysqli_fetch_array($query_result)){
    $accessKey='ZIdM50EJH3PqLE1FMeslyAyAf3BNC2nq3VpC3TFp';
    $secretKey='RIPOY78DZ-EcwVahqBQLMPXd6crMEK5i5iKTXZxd';

    $auth=new Auth($accessKey,$secretKey);
    $bucketMgr=new BucketManager($auth);
    $bucket='course-assist';
    $key=$fetched['path'];      //file path

    $err=$bucketMgr->delete($bucket,$key);
    if($err!=null){
        $result = array(
            "code" => -1,
            "msg" => "删除失败",
            "res" => array()
        );
        echo json_encode($result);
    }
    else{
        $deleteRes=mysqli_query($conn, "delete FROM resource WHERE resrc_id = '$resource_id';");
        if($deleteRes){
            $result = array(
                "code" => 0,
                "msg" => "删除成功",
                "res" => array()
            );
            echo json_encode($result);
        }
        else{
            $result = array(
                "code" => -1,
                "msg" => "数据库删除记录失败，请联系管理员",
                "res" => array()
            );
            echo json_encode($result);
        }
    }

//   if (unlink($path)) {
//        mysqli_query($conn, "delete FROM resource WHERE resrc_id = '$resource_id';");
//        $result = array(
//            "code" => 0,
//            "msg" => "删除成功",
//            "res" => array(
//                "token" => $_SESSION['token']
//            )
//        );
//        echo json_encode($result);
//    } else {
//        $result = array(
//            "code" => -1,
//            "msg" => "删除失败",
//            "res" => array(
//                "token" => $_SESSION['token']
//            )
//        );
//        echo json_encode($result);
//    }
}
else{
    $result = array(
        "code" => -1,
        "msg" => "没有这个资源",
        "res" => array()
    );
    echo json_encode($result);
}
mysqli_close($conn);
?>