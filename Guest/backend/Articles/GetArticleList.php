
<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();

$Page_size=9;  //一页文章数量
$teacher_upload=0;  //教师上传的文章
$result=mysqli_query($conn,"SELECT * from article  where authority = '$teacher_upload'");
$count = mysqli_num_rows($result);
$page_count = ceil($count/$Page_size);  //总共多少页

$init=1;  //第一页
$page_len=7;  
$max_p=$page_count;  
$pages=$page_count;

//判断当前页码
if(empty($_GET['page'])||$_GET['page']<0){  //页码为空或<0
    $page=1;
}
else{
    $page=$_GET['page'];
}

$offset=$Page_size*($page-1);  


$sql="SELECT * from article where authority = '$teacher_upload' limit $offset,$Page_size";
$result=mysqli_query($conn,$sql);
$col = 1;  //用于判断一行三篇文章
while ($row=mysqli_fetch_array($result)) {
    if($col % 3 == 0)
    {
        ?>
        <div class="row">
        <?php
    }
?> 
        <div class="col-md-4 text-center">
            <div class="services">
                <span></span>
                <h5 style=""><?php echo $row['title']?></h5>
                </br>
                <h6 style="font-family:'Microsoft YaHei'"><?php echo $row['author']?></h6>
                <?php echo $row['time']?>
                <br>
                <p style="font-family:'Microsoft YaHei'">
                <?php
                    $content = $row['content'];
                    $htmlcontent = htmlspecialchars_decode(mb_substr($content,0,60,'utf-8'));  //截取文章前61个字作简介       
                	echo strip_tags($htmlcontent);
                ?>…
                </p>
               
                <div class="cd-see-all"><a href="NewPassage.php?art_id=<?php echo $row['art_id']?>" target="_blank" class="btn btn-1" >详细</a></div>
           </div>
        </div>
    
<?php
    if($col % 3 == 0)
    {
        ?>
        </div>
        <?php
    }
    $col++;
};
?>
<?php
$page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
$pageoffset = ($page_len-1)/2;  //页码个数左右偏移量

$key='<div class="col-md-12"
align="center"><div class="pagination" >';
$key.="<li class='disabled'style='background-color: black'><span>$page/$pages</span></li> "; //第几页,共几页
if($page!=1){
    $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=1\">第一页</a></li> "; //第一页
    $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">&laquo;</a></li>"; //上一页
}
else {
    $key.="<li class='disabled'><span>第一页</span></li> ";//第一页
    $key.="<li class='disabled'><span>&laquo;</span></li>"; //上一页
}
if($pages>$page_len){
//如果当前页小于等于左偏移
    if($page<=$pageoffset){
        $init=1;
        $max_p = $page_len;
    }
    else{//如果当前页大于左偏移
//如果当前页码右偏移超出最大分页数
        if($page+$pageoffset>=$pages+1){
            $init = $pages-$page_len+1;
        }
        else{
//左右偏移都存在时的计算
            $init = $page-$pageoffset;
            $max_p = $page+$pageoffset;
        }
    }
}
for($i=$init;$i<=$max_p;$i++){
    if($i==$page){
        $key.=' <li class="active"><span>'.$i.'</span></li>';
    } 
    else {
        $key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
    }
}
if($page!=$pages){
    $key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">&raquo</a></li> ";//下一页
    $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页</a></li>"; //最后一页
}
else {
    $key.="<li class='disabled'><span>&raquo;</span></li> ";//下一页
    $key.="<li class='disabled'><span>最后一页</span></li>"; //最后一页
}
$key.='</div></div>';
?>
<?php echo $key?>


