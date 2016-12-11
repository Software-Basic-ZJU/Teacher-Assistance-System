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
            "res" => null
        );
        echo json_encode($result);
        exit;
    }
    $query_result = mysqli_query($conn, "select * from posts WHERE section = '$section' AND teacher_id = '$teacher_id' AND group_id = '$group_id';");
    if($query_result){//当语句正确的时候
        $fetched = mysqli_fetch_array($query_result);
        $postList = array();
        //
        while($fetched = mysqli_fetch_array($query_result)){//能查到数据的时候
            $author_id = $fetched['author_id'];
            $post_id = $fetched['post_id'];

            $getName_result = mysqli_query($conn, "select * from student WHERE student_id = '$author_id';");//通过id查找姓名
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
                        "code" => 403,
                        "msg" => "发布者身份非法",
                        "res" => null
                    );
                    echo json_encode($result);
                    exit;
                }
            }

            //查询本帖子有多少回帖
            $getReplyNum_result = mysqli_query($conn, "select COUNT(DISTINCT repost_id) as reply_num from reply_post WHERE post_id = '$post_id';");
            if($fetched_num = mysqli_fetch_array($getReplyNum_result)){
                $reply_num = $fetched_num['reply_num'];
            }
            //查询本帖子的附件
            $getResource_result = mysqli_query($conn, "select * from resource WHERE post_id = '$post_id' AND type = 1;");
            if($fetched_resource = mysqli_fetch_array($getResource_result)){
                $attachment = array(
                    "resrc_id" => $fetched_resource['resrc_id'],
                    "name" => $fetched_resource['name'],
                    "path" => $fetched_resource['path'],
                    "size" => $fetched_resource['size']
                );
            }
            else{
                $attachment = null;
            }

            $postList[] = array(
                "post_id" => $post_id,
                "title" => $fetched['title'],
                "content" => $fetched['content'],
                "author_id" => $author_id,
                "author_name" => $author_name,
                "publish_time" => $fetched['publish_time'],
                "update_time" => $fetched['update_time'],
                "reply_num" => $reply_num,
                "attachment" => $attachment
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
else{
    $query_result = mysqli_query($conn, "select * from posts WHERE section = '$section' AND teacher_id = '$teacher_id';");
    if($query_result){
        $fetched = mysqli_fetch_array($query_result);
        $postList = array();//post_id,title,content,author_id,author_name,publish_time,update_time,reply_num,attachment[String](resource_id,name,path,size)
        while($fetched = mysqli_fetch_array($query_result)){
            $author_id = $fetched['author_id'];
            $post_id = $fetched['post_id'];

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
                        "code" => 2,
                        "msg" => "无此上传人",
                        "res" => null
                    );
                    echo json_encode($result);
                    exit;
                }
            }

            $getReplyNum_result = mysqli_query($conn, "select COUNT(DISTINCT repost_id) as reply_num from reply_post WHERE post_id = '$post_id';");
            if($fetched_num = mysqli_fetch_array($getReplyNum_result)){
                $reply_num = $fetched_num['reply_num'];
            }

            $getResource_result = mysqli_query($conn, "select * from resource WHERE post_id = '$post_id' AND type = 1;");
            if($fetched_resource = mysqli_fetch_array($getResource_result)){
                $attachment = array(
                    "resrc_id" => $fetched_resource['resrc_id'],
                    "name" => $fetched_resource['name'],
                    "path" => $fetched_resource['path'],
                    "size" => $fetched_resource['size']
                );
            }
            else{
                $attachment = null;
            }

            $postList[] = array(
                "post_id" => $post_id,
                "title" => $fetched['title'],
                "content" => $fetched['content'],
                "author_id" => $author_id,
                "author_name" => $author_name,
                "publish_time" => $fetched['publish_time'],
                "update_time" => $fetched['update_time'],
                "reply_num" => $reply_num,
                "attachment" => $attachment
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
            "code" => 1,
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