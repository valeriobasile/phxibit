<?php include("mysql.php");?>
<?
$text = $_POST["text"];
$link = $_POST["link"];

$sql = "update news set text = '".$text."', link = '".$link."';";
$result = mysql_query($sql) or die (mysql_error());

header("location:news.php");	

?>
