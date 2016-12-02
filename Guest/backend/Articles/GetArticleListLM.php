
<?php
echo 1;
include dirname(dirname(__FILE__)).'/connectDB.php';
echo 2;
global $conn;


connectDB();
echo 3;
$Page_size=10;

$result=mysqli_query($conn,'select * from article');
$count = mysqli_num_rows($result);
$page_count = ceil($count/$Page_size);

$init=1;
$page_len=7;
$max_p=$page_count;
$pages=$page_count;

//判断当前页码
if(empty($_GET['page'])||$_GET['page']<0){
$page=1;
}
else{
$page=$_GET['page'];
}

$offset=$Page_size*($page-1);
$sql="select * from article limit $offset,$Page_size";
$result=mysqli_query($conn,$sql);
echo 3;
while ($row=mysqli_fetch_array($result)) {
?>
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="services">
                <span><i class="sl-icon-graph"></i></span>
                <h3><?php echo $row['title']?></h3>
                <h4><?php echo $row['author']?></h4>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <h5><?php echo $row['time']?></h5>
                <div class="cd-see-all"><a href="NewPassage.php?art_id=<?php echo $row['art_id']?>" class="btn btn-1" >详细</a></div>
            </div>
        </div>
    </div>

}
<?php
};
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量

$key='<div class="page">';
$key.="<span>$page/$pages</span> "; //第几页,共几页
if($page!=1){
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">第一页</a> "; //第一页
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">上一页</a>"; //上一页
}else {
$key.="第一页 ";//第一页
$key.="上一页"; //上一页
}
if($pages>$page_len){
//如果当前页小于等于左偏移
if($page<=$pageoffset){
$init=1;
$max_p = $page_len;
}else{//如果当前页大于左偏移
//如果当前页码右偏移超出最大分页数
if($page+$pageoffset>=$pages+1){
$init = $pages-$page_len+1;
}else{
//左右偏移都存在时的计算
$init = $page-$pageoffset;
$max_p = $page+$pageoffset;
}
}
}
for($i=$init;$i<=$max_p;$i++){
if($i==$page){
$key.=' <span>'.$i.'</span>';
} else {
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>";
}
}
if($page!=$pages){
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页</a> ";//下一页
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页</a>"; //最后一页
}else {
$key.="下一页 ";//下一页
$key.="最后一页"; //最后一页
}
$key.='</div>';
?>
<?php echo $key?>

