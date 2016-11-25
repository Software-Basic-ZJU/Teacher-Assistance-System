<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
<h2>留言板TEST</h2>

<?php
include 'GetMessage.php';
for($i=0; $i<count($message); $i++)
{
	foreach ($message[$i] as $key => $value) 
	{
		if($key == "msg_id")
		{
			$id = $value;
		}
		echo $key . " = " . $value;
		echo "<br>";
	}
	?>
	<form action="ReplyMessage.php" method="get"> 
		<input type="content" name="reply_content">
		<input type="hidden" name="msg_id" value="<?php echo $id;?>">
	<input type="submit" value="回复">
	</form>
	<?php 
	echo $id;
	echo "<br>";
}
?>




<form method="post" action="SendMessage.php">
    留言：<input type="content" name="content">
    <br><br>
    <input type="submit" name="submit" value="提交">
</form>


</body>
</html>

