<?php
include("header.php");
include("db.php");
?>

		<div id="imgHome">
			<div id="news">
<?
$sql = "select * from news;";
$result = $dbh->query($sql);
$row = $result->fetch();
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
