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
                <form role="form" id="reply" action="./backend/MessageBoard/Reply.php" method="post">
                    
                        <div class="col-sm-10">
                            <div class="form-group">
                                
                                <textarea  class="form-control" name="reply" rows="3" value=""></textarea>
                            </div>
                        </div>
                            <input type="hidden" name="msg_id" value="<?php echo $fetched['msg_id']?>">
                            <input type="hidden" name="token" value="">

                    <button type="button" name="replySubmit" class="btn btn-info" style="" onclick="testToken">提交</button>
                </form>
            </div>
                    <script>
                        function testToken(){
                            var LS={              //封装的类
                                setItem(key,value){
                                    if(typeof value=='object') value=JSON.stringify(value);
                                    localStorage.setItem(key,value);
                                },
                                getItem(key){
                                    let temp=localStorage.getItem(key);
                                    let res=null;
                                    if(res=JSON.parse(temp)) return res;
                                    return temp;
                                },
                                removeItem(key){
                                    localStorage.removeItem(key);
                                },
                                clear(){
                                    Vue.http.headers.common['x-access-token']="";
                                    localStorage.clear();
                                }
                            }

                            //将本地存储中的token取出并检测
                            var userInfo=LS.getItem('userInfo');
                            if(userInfo || userInfo.token){
                                document.getElementsByName("token")[0].value=userInfo.token;
                                var replyDom=document.getElementById("reply");
                                console.log(replyDom);
                                replyDom.submit();
                            }else{
                                alert("未登录");
                            }
                        }
                    </script>

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