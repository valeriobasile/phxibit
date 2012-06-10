<?php include("header.php");?>
<?php
if (isset($_GET["topic"])){
	$id = $_GET["topic"];

	$sql = "select * from topic where id = ".$id.";";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	$name = $row["name"];
	$description = $row["description"];
?>
<form action="confirmUpdateTopic.php" method="post" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="text" name="name" len="100" value="<?=str_replace("\"", "&quot;", $name)?>" />
<br/>
<textarea name="description"><?=$description?></textarea>
<br/>
<input type="submit" value="save" />
</form>
<?
}
?>
<?php include("footer.php");?>

