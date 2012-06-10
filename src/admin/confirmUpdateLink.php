<?php include("db.php");?>
<?
$id = $_POST["id"];
$url = $_POST["url"];
$description = $_POST["description"];

$sql = "update link set url = '".$url."', description = '".$description."' where id = ".$id.";";
$result = $dbh->query($sql);
header("location:links.php");	
$dbh = null;
?>
