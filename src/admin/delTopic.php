<?php include("mysql.php");?>
<?php
if (isset($_GET["topic"])){
	$id = $_GET["topic"];

	$sql = "delete from topic where id = ".$id.";";
	mysql_query($sql) or die (mysql_error());
	
	$sql = "delete from work where topic = ".$id.";";
	mysql_query($sql) or die (mysql_error());
	
	$files = glob("../works/".$id."-*.jpg");
	array_map('unlink', $files);

	$sql = "select id from topic where id > ".$id." order by id;";
	$result = mysql_query($sql) or die (mysql_error());
	while ($row = mysql_fetch_assoc($result)){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update topic set id = ".$new_id." where id = ".$old_id.";";
		mysql_query($sql) or die (mysql_error());
		$sql = "update work set topic = ".$new_id." where topic = ".$old_id.";";
		mysql_query($sql) or die (mysql_error());
		
		$files = glob("../works/".$old_id."-*.jpg");
		foreach ($files as $file){
			$work_id = preg_replace("/.*-/","",$file);
			$work_id = preg_replace("/\.jpg/","",$work_id);
			rename($file, "../works/".$new_id."-".$work_id.".jpg");
		}
	}

	$sql = "select id from topic where id = ".$id." order by id;";
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
	$old_id = $row["id"];
	$new_id = $row["id"] - 1;

	$files = glob("../works/".$old_id."-*.jpg");
	foreach ($files as $file){
		$work_id = preg_replace("/.*-/","",$file);
		$work_id = preg_replace("/\.jpg/","",$work_id);
		rename($file, "../works/".$old_id."-".$work_id.".jpg");
	}

}
mysql_close();
header("location:works.php");
?>
