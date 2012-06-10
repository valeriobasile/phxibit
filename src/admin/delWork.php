<?php include("db.php");?>
<?php
if (isset($_GET["topic"]) && isset($_GET["work"])){
	$topic_id = $_GET["topic"];
	$work_id = $_GET["work"];
	$picture_dir = "../works/";
	
	$sql = "delete from work where topic = ".$topic_id." and id = ".$work_id.";";
	$dbh->query($sql);
	unlink($picture_dir.$topic_id."-".$work_id.".jpg");
	
	$sql = "select id from work where topic = ".$topic_id." and id > ".$work_id." order by id;";
	$result = $dbh->query($sql);
	while ($row = $result->fetch()){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update work set id = ".$new_id." where topic = ".$topic_id." and id = ".$old_id.";";
		$dbh->query($sql);
		try{
			rename($picture_dir.$topic_id."-".$old_id.".jpg", $picture_dir.$topic_id."-".$new_id.".jpg");
		}
		catch(exception $e){}
	}
}
$dbh = null;
header("location:works.php?topic=".$topic_id);
?>
