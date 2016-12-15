<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();

$query_message = mysqli_query($conn, "select * from message where msg_state = 1") or die(mysqli_error($mysqli));
$count = 1;
while($fetched = mysqli_fetch_array($query_message))
{
?>
    <div class="container">
        <div id="board" class="well well-lg sr-button">
            <div class="row text-center">
                <div class="col-sm-2">
                    <img src="./images/default.jpg" class="img-circle" style="height: 80px; width: 80px;">
                    <p class="text-info"><?php echo $fetched['time']; ?>
                </div>
                <div class="col-sm-8">
                    <p class="bg-form" align="left"><?php echo $fetched['content']; ?></p>
                </div>
                <?php 
                if($fetched['reply_content']){
                ?>
                        <div id="replyboard" class="col-sm-9">
                            <p  class="bg-form"  align="left">回复:<?php echo $fetched['reply_content']; ?></p>
                        </div>
                <?php
                }
                else{
                    ?>
                            <div class="col-sm-2">
                                <a href="#reply<?php echo $count?>" class="btn btn-info" data-toggle="collapse" onclick="display('reply<?php echo $count?>' )">回复</a>
                            </div>
            <div id="reply<?php echo $count?>" class="col-sm-10" style="display: none;">
                <form role="form" action="./backend/MessageBoard/Reply.php" method="post">
                    
                        <div class="col-sm-10">
                            <div class="form-group">
                                
                                <textarea  class="form-control" name="reply" rows="3" value=""></textarea>
                            </div>
                        </div>
                            <input type="hidden" name="msg_id" value="<?php echo $fetched['msg_id']?>"> 
                                <button type="submit" name="replySubmit" class="btn btn-info" style="">提交</button>
                            
                </form>
            </div>

                <?php
                }
                ?>
            

        </div>
    </div>
</div>
<?php
$count++;
}
mysqli_close($conn);
echo '<br><br>';

?>

<script type="text/javascript">
function display(id){
    var traget=document.getElementById(id);
    if(traget.style.display=="none"){
    traget.style.display="";
    }
    else{
    traget.style.display="none";
    }
}
</script> 