
<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();

$result=mysqli_query($conn,'SELECT * FROM article LIMIT 3');
$count = mysqli_num_rows($result);

while ($row=mysqli_fetch_array($result)) {    
?> 
        <div class="col-md-4 text-center">
            <div class="services" >
                <span><i class="sl-icon-graph"></i></span>
                <h5><?php echo $row['title']?></h5>
                </br></br>
                <p style="font-family:'Microsoft YaHei'">
                <?php
                    $content = $row['content'];
                    $htmlcontent = htmlspecialchars_decode(mb_substr($content,0,60,'utf-8'));  //截取文章前61个字作简介       
                    echo strip_tags($htmlcontent);     
                ?>…
                </p>
                </br>
                <div class="cd-see-all"><a href="Guest/NewPassage.php?art_id=<?php echo $row['art_id']?>" target="_blank" class="btn btn-1" >详细</a></div>
           </div>
        </div>
    
<?php
};
?>




