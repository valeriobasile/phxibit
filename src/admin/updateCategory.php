<?php include("header.php");?>
<?php
if (isset($_GET["category"])){
	$id = $_GET["category"];

	$sql = "select * from category where id = ".$id.";";
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
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

