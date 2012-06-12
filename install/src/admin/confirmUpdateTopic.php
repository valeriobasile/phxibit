<?php include("db.php");?>
<?
$id = $_POST["id"];
$name = $_POST["name"];
$description = $_POST["description"];

$sql = "update topic set name = '".$name."', description = '".$description."' where id = ".$id.";";
$result = $dbh->query($sql);
header("location:works.php?topic=".$id);	
$dbh = null;
?>
