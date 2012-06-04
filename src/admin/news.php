<?php include("header.php");?>
<div class="box">
<h1>News</h1>
<?php
$sql = "select * from news;";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$text = $row["text"];
$link = $row["link"];
?>
<form action="confirmUpdateNews.php" method="post" >
<textarea name="text"><?=$text?></textarea>
<br/>
<input type="text" name="link" value="<?=$link?>" />
<br/>
<input type="submit" value="save" />
</form>
</div>
<?php include("footer.php");?>

