<?php include("mysql.php");?>
<?php
if (isset($_GET["topic"]) && isset($_GET["work"])){
	$id_topic = $_GET["topic"];
	$id_work = $_GET["work"];
	$picture_dir = "../works/";

	$sql = "select max(id) as max_id from work where topic = ".$id_topic.";";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$max_id = $row["max_id"];

	if ($id_work < $max_id){
		$new_id = $id_work + 1;

		# 0 is used as temp id
		$sql = "update work set id = 0 where topic = ".$id_topic." and id = ".$id_work.";";
		mysql_query($sql) or die (mysql_error());
		rename($picture_dir.$id_topic."-".$id_work.".jpg", $picture_dir.$id_topic."-0.jpg");

		$sql = "update work set id = ".$id_work." where topic = ".$id_topic." and id = ".$new_id.";";
		mysql_query($sql) or die (mysql_error());
		rename($picture_dir.$id_topic."-".$new_id.".jpg", $picture_dir.$id_topic."-".$id_work.".jpg");

		$sql = "update work set id = ".$new_id." where topic = ".$id_topic." and id = 0;";
		mysql_query($sql) or die (mysql_error());
		rename($picture_dir.$id_topic."-0.jpg", $picture_dir.$id_topic."-".$new_id.".jpg");
	}
}
mysql_close();
//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");header("location:works.php?topic=".$id_topic);
?>
