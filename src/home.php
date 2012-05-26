<?php
include("header.php");
include("mysql.php");
?>

		<div id="imgHome">
			<div id="news">
<?
$sql = "select * from news;";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$text = $row["text"];
$link = $row["link"];
?>

<?php
echo str_replace("\n", "<br />\n", $text);
?>
<br />
<a href="<?=$link?>">
<?=$link?>
</a>

			</div>
		</div>
	
<?php
include("footer.php");
?>
