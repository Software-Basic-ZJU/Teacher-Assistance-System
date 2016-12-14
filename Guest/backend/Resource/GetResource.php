<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();

$fileType = array("doc", "docx", "ppt", "pptx" , "xls", "xlsx", "rar", "zip", "txt", "pdf");


$query_resource = mysqli_query($conn, "select * from resource where type = 0") or die(mysqli_error($mysqli));
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
                        <img src="images/resource/<?php echo $type; ?>.png" class="ppticon" style="height: 200px;width: 200px;margin-bottom:10px; ">
                    
                    </br>
                    <a href="<?php echo $fetched['path'] ?>" style="font-family:'Microsoft YaHei'"><?php echo $fetched['name'] ?></a>
                    <p><?php echo $fetched['time'] ?>
                    <br></br> 
                    </p>
                </div>
            </div>


        

<?php
$count++;
}

mysqli_close($conn);

?>
