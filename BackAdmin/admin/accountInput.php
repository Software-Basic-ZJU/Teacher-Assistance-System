<?php
date_default_timezone_set('Africa/Lagos');
//include 'connectDB.php';
//connectDB();测试用的

header('Content-type: application/json');
session_start();
// Connect database
include '../login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);


/*
if (file_exists("../upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }

else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../upload/" . $_FILES["file"]["name"]);
      //echo"success";
      //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
*/
//move_uploaded_file($_FILES["file"]["tmp_name"],
//      "../accountupload/" . $_FILES["file"]["name"]);

/*
if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$file_path)) {
$error = "error|上传文件错误.";
exit(0);
}
*/


//下面开始获取你上传的excel数据了

//获取上传表格的数据
//$file_name = "d:/upload/".$_FILES["file"]["name"];//获取上传文件的地址名称
$file_name =  $_FILES["file"]["tmp_name"];//获取上传文件的地址名称
$fileArr=explode(".",$_FILES["file"]["name"]);
$type=$fileArr[count($fileArr)-1];
//chmod($file_name,0777);
//echo "------";
//echo $file_name;
//echo "------";
require_once '../Excel/PHPExcel.php';
//echo 'phpexcel success';
require_once '../Excel/PHPExcel/IOFactory.php';
require_once '../Excel/PHPExcel/Cell.php';
if($type=="xls"){
    $objReader = PHPExcel_IOFactory::createReader('Excel5'); //建立reader对象
}
else if($type=="xlsx") {
    $objReader = PHPExcel_IOFactory::createReader('Excel2007'); //建立reader对象
}
else{
    $result = array (
        "code"=>"1",
        "msg"=>"上传文件格式错误",
        "type"=>$type
    );
    echo json_encode($result);
    exit;
}

$objPHPExcel = $objReader->load($file_name);
$sheet = $objPHPExcel->getSheet();
$highestRow = $sheet->getHighestDataRow(); // 取得总行数
$highestColumn = $sheet->getHighestColumn();

for($j=2;$j<=$highestRow;$j++)
{
    unset($arr_result);
    unset($strs);
    for($k='A';$k<='C';$k++)
    {
        //读取单元格
        $arr_result  .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().',';
    }
    $strs=explode(",",$arr_result);
    //$sql="insert into student (student_id,name,class_id,password) values ('$strs[0]','$strs[1]',$strs[2],'123456');";
    //echo $sql."<br/>";
    $password=encrypt('123456');
    $result=mysqli_query($conn,
        "INSERT INTO student (student_id,name,class_id,password) VALUES ('$strs[0]','$strs[1]',$strs[2],'$password');");

    if(!$result) {
        $result = array (
            "code"=>"1",
            "msg"=>"导入名单过程出现错误");
        echo json_encode($result);
        exit;
    }

}

$result = array (
    "code"=>"0",
    "msg"=>"增加成功");
echo json_encode($result);
mysqli_close($conn);

?>