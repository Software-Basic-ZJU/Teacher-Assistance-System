<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();

$fileType = array("doc", "docx", "ppt", "pptx" , "xls", "xlsx", "rar", "zip", "txt", "pdf");

$teacher_upload=0;  //教师上传的资源

$query_resource = mysqli_query($conn, "SELECT * from resource where type = 0 and authority = '$teacher_upload' ") or die(mysqli_error($mysqli));
$count = 1;

while($fetched = mysqli_fetch_array($query_resource))
{
    $type = pathinfo($fetched['path'])['extension']; 
if(!in_array($type,$fileType))
    $type = "default";

?>
        
            <div class="col-xs-3 text-center">
                <div class="resources-1">
                    <span></span>
                        <img src="images/resource/<?php echo $type; ?>.png" class="ppticon" style="height: 160px;width: 160px;margin-bottom:10px; ">
                    
                    </br>
                    <a href="<?php echo 'http://ohqv9jyy7.bkt.clouddn.com/'.$fetched['path'] ?>" download="<?php echo $fetched['name'] ?>" style="font-family:'Microsoft YaHei'"><?php echo $fetched['name'] ?></a>
                    <p><?php echo $fetched['time'] ?>
                    <br />
                    </p>
                </div>
            </div>


        

<?php
$count++;
}

mysqli_close($conn);

?>
