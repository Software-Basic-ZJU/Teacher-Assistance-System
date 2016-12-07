<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();

$query_message = mysqli_query($conn, "select * from message where msg_state = 1") or die(mysqli_error($mysqli));
$count = 1;
while($fetched = mysqli_fetch_array($query_message))
{
?>
    <div class="container" style="margin-top: 10px">
        <div class="well well-lg sr-button">
            <div class="row text-center">
                <div class="col-sm-2">
                    <p class="text-info"><?php echo $fetched['time']; ?>
                </div>
                <div class="col-sm-8">
                    <p class="bg-form"  align="left"><?php echo $fetched['content']; ?></p>
                </div>
                <?php 
                if(!$fetched['reply_content']){
                ?>
                <div class="col-sm-2">
                    <a href="#reply<?php echo $count?>" class="btn btn-info" data-toggle="collapse">回复</a>
                </div>
                <?php
                }
                else{
                    ?>
                <div class="col-sm-8">
                    <p class="bg-form"  align="left">回复:<?php echo $fetched['reply_content']; ?></p>
                </div>
                <?php
                }
                ?>
            </div>
            <div id="reply<?php echo $count?>" class="collapse">
                <form role="form" action="./backend/MessageBoard/Reply.php" method="post">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="reply">回复:</label>
                                <textarea class="form-control" name="reply" rows="4" value=""></textarea>
                            </div>
                            <input type="hidden" name="msg_id" value="<?php echo $fetched['msg_id']?>">
                            <div class="col-sm-12 text-center">
                                <button type="submit" name="replySubmit" class="btn btn-default btn-xl sr-button" style="background-color:#F05F40">提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
$count++;
}
mysqli_close($conn);
echo '<br><br>';

?>
