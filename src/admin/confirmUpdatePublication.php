<?php include("mysql.php");?>
<?
$id = $_POST["id"];
$title = $_POST["title"];
$category = $_POST["category"];
$description = $_POST["description"];
$text = $_POST["text"];

$sql = "update publication set title = '".$title."', description = '".$description."', text = '".$text."' where category = ".$category." and id = ".$id.";";
$result = mysql_query($sql) or die (mysql_error());
header("location:publications.php?category=".$category);	
mysql_close();
?>
