<?php include("mysql.php");?>
<?
$id = $_POST["id"];
$url = $_POST["url"];
$description = $_POST["description"];

$sql = "update link set url = '".$url."', description = '".$description."' where id = ".$id.";";
$result = mysql_query($sql) or die (mysql_error());
header("location:links.php");	
mysql_close();
?>
