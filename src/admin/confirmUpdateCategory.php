<?php include("mysql.php");?>
<?
$id = $_POST["id"];
$name = $_POST["name"];

$sql = "update category set name = '".$name."' where id = ".$id.";";
$result = mysql_query($sql) or die (mysql_error());
header("location:publications.php?category=".$id);	
mysql_close();
?>
