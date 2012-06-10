<?php include("db.php");?>
<?
$id = $_POST["id"];
$name = $_POST["name"];

$sql = "update category set name = '".$name."' where id = ".$id.";";
$result = $dbh->query($sql);
header("location:publications.php?category=".$id);	
$dbh = null;
?>
