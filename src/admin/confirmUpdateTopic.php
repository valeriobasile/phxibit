<?php include("mysql.php");?>
<?
$id = $_POST["id"];
$name = $_POST["name"];
$description = $_POST["description"];

$sql = "update topic set name = '".$name."', description = '".$description."' where id = ".$id.";";
$result = mysql_query($sql) or die (mysql_error());
header("location:works.php?topic=".$id);	
mysql_close();
?>
