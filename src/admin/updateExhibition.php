<?php include("header.php");?>
<?php
if (isset($_GET["exhibition"])){
	$id = $_GET["exhibition"];

	$sql = "select * from exhibition where id = ".$id.";";
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
	$title = $row["title"];
	$description = $row["description"];
?>
<form action="confirmUpdateExhibition.php" method="post" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="text" name="title" len="100" value="<?=str_replace("\"", "&quot;", $title)?>" />
<br/>
<textarea name="description"><?=$description?></textarea>
<br/>
<input type="submit" value="save" />
</form>
<?
}
?>
<?php include("footer.php");?>

