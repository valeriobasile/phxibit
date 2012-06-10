<?php include("db.php");?>
<?
$id = $_POST["id"];
$title = $_POST["title"];
$topic = $_POST["topic"];
$description = $_POST["description"];
$vimeo_url = $_POST["vimeo_url"];

$sql = "update work set title = '".$title."', description = '".$description."', vimeo_url = '".$vimeo_url."' where topic = ".$topic." and id = ".$id.";";
$result = $dbh->query($sql);
header("location:works.php?topic=".$topic);	
$dbh = null;
?>
