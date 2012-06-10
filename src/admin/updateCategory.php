<?php include("header.php");?>
<?php
if (isset($_GET["category"])){
	$id = $_GET["category"];

	$sql = "select * from category where id = ".$id.";";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	$name = $row["name"];
?>
<form action="confirmUpdateCategory.php" method="post" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="text" name="name" len="100" value="<?=str_replace("\"", "&quot;", $name)?>" />
<br/>
<input type="submit" value="save" />
</form>
<?
}
?>
<?php include("footer.php");?>

