<?php include("db.php");?>
<?
$text = $_POST["text"];
$link = $_POST["link"];

$sql = "update news set text = '".$text."', link = '".$link."';";
$result = $dbh->query($sql);

header("location:news.php");	

?>
