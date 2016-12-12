<?php
include dirname(dirname(__FILE__)).'/connectDB.php';
global $conn;
connectDB();

$query_resource = mysqli_query($conn, "select * from resource where type = 0") or die(mysqli_error($mysqli));
$count = 1;
?>
<div class="portfolio-row-half">
<?php
while($fetched = mysqli_fetch_array($query_resource))
{
?>
        
            <a href="<?php echo $fetched['path'] ?>" class="portfolio-grid-item" style="background-image: url(images/excelicon.png);background-size: 30%;background-position-y: 80px;background-repeat: no-repeat; height: 300px">
                <div class="desc2">
                    <h3><?php echo $fetched['name'] ?></h3>
                    <span><?php echo $fetched['time'] ?></span>
                    <i class="sl-icon-heart">
                    	<?php 
                    	echo pathinfo($fetched['path'])['extension']; 
                    	?> 						
                    </i>
                </div>
            </a>
        

<?php
$count++;
}
?>
</div> 
<?php
mysqli_close($conn);
echo '<br><br>';
?>
