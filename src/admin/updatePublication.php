<?php include("header.php");?>
<?php
if (isset($_GET["category"]) && isset($_GET["publication"])){
	$id_category = $_GET["category"];
	$id_publication = $_GET["publication"];

	$sql = "select * from publication where category = ".$id_category." and id = ".$id_publication.";";
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
	$title = $row["title"];
	$description = $row["description"];
	$text = $row["text"];
?>
<form action="confirmUpdatePublication.php" method="post" />
<input type="hidden" name="id" value="<?=$id_publication?>" />
<input type="hidden" name="category" value="<?=$id_category?>" />
<input type="text" name="title" len="100" value="<?=str_replace("\"", "&quot;", $title)?>" />
<br/>
<textarea name="description"><?=$description?></textarea>
<br/>
<textarea name="text"><?=$text?></textarea>
<br/>
<input type="submit" value="save" />
</form>
<?
}
?>
<?php include("footer.php");?>

