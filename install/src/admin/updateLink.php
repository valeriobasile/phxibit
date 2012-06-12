<?php include("header.php");?>
<?php
if (isset($_GET["link"])){
	$id = $_GET["link"];

	$sql = "select * from link where id = ".$id.";";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	$url = $row["url"];
	$description = $row["description"];
?>
<form action="confirmUpdateLink.php" method="post" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="text" name="url" len="100" value="<?=str_replace("\"", "&quot;", $url)?>" />
<br/>
<textarea name="description"><?=$description?></textarea>
<br/>
<input type="submit" value="save" />
</form>
<?
}
?>
<?php include("footer.php");?>

