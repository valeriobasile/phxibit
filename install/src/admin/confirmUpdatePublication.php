<?php include("db.php");?>
<?
$id = $_POST["id"];
$title = $_POST["title"];
$category = $_POST["category"];
$description = $_POST["description"];
$text = $_POST["text"];

$sql = "update publication set title = '".$title."', description = '".$description."', text = '".$text."' where category = ".$category." and id = ".$id.";";
$result = $dbh->query($sql);
header("location:publications.php?category=".$category);	
$dbh = null;
?>
