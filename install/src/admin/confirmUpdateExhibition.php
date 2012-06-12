<?php include("db.php");?>
<?
$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];

$sql = "update exhibition set title = '".$title."', description = '".$description."' where id = ".$id.";";
$result = $dbh->query($sql);
header("location:exhibitions.php");	
$dbh = null;
?>
