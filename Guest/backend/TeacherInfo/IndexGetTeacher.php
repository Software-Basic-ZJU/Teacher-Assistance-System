
<?php

$result=mysqli_query($conn,'SELECT * FROM teacher');

while ($row=mysqli_fetch_array($result)) {    
?> 

                <li>
                    <p style="font-family:'Microsoft YaHei'"><?php echo $row['brief_intro']?></p>
                    <div class="cd-author">
                        <img src="<?php echo $row['photo_path']?>" alt="Author image">
                        <ul class="cd-author-info">
                            <li><?php echo $row['name']?></li>
                            <li><?php echo $row['course_info']?></li>
                        </ul>
                    </div>
                </li>
    
<?php
};
?>




