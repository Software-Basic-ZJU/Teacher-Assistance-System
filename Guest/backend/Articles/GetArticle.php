<?php
//header('Content-type: application/json;charset=utf-8');
include '../connectDB.php';

global $conn;
connectDB();

$art_id = 1;
$art_id = $_GET['art_id'];
$query_article = mysqli_query($conn, "SELECT * FROM article WHERE art_id = '$art_id'");

if($fetched = mysqli_fetch_array($query_article))
{
   //Articles(title,content,author,time)
        $result = array(
            "code" => 0,
            "msg" => "读取成功",
            "res" => array(
                "art_id" => $art_id,
                "title" => $fetched['title'],
                "time" => $fetched['time'],
                "author" => $fetched['author'],
                "content" => $fetched['content']
                )
        );
}
else{
    $result = array(
        "code" => 1,
        "msg" => "读取失败",
        "res" => null
    );
    }
    echo json_encode($result,JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
echo '<br><br>';

?>