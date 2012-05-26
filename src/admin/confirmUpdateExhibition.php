<?php include("mysql.php");?>
<?
$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];

$sql = "update exhibition set title = '".$title."', description = '".$description."' where id = ".$id.";";
$result = mysql_query($sql) or die (mysql_error());
header("location:exhibitions.php");	
mysql_close();
?>
