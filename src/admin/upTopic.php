<?php include("mysql.php");?>
<?php
if (isset($_GET["topic"])){
	$id = $_GET["topic"];

	$sql = "select max(id) as max_id from topic;";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$max_id = $row["max_id"];

	if ($id < $max_id){
		$new_id = $id + 1;

		# 0 is used as temp id
		$sql = "update topic set id = 0 where id = ".$id.";";
		mysql_query($sql) or die (mysql_error());
		$sql = "update work set topic = 0 where topic = ".$id.";";
		mysql_query($sql) or die (mysql_error());

		$files = glob("../works/".$id."-*.jpg");
		foreach ($files as $file){
			$work_id = preg_replace("/.*-/","",$file);
			$work_id = preg_replace("/\.jpg/","",$work_id);
			rename($file, "../works/0-".$work_id.".jpg");
		}

		$sql = "update topic set id = ".$id." where id = ".$new_id.";";
		mysql_query($sql) or die (mysql_error());
		$sql = "update work set topic = ".$id." where topic = ".$new_id.";";
		mysql_query($sql) or die (mysql_error());

		$files = glob("../works/".$new_id."-*.jpg");
		foreach ($files as $file){
			$work_id = preg_replace("/.*-/","",$file);
			$work_id = preg_replace("/\.jpg/","",$work_id);
			rename($file, "../works/".$id."-".$work_id.".jpg");
		}

		$sql = "update topic set id = ".$new_id." where id = 0;";
		mysql_query($sql) or die (mysql_error());
		$sql = "update work set topic = ".$new_id." where topic = 0;";
		mysql_query($sql) or die (mysql_error());

		$files = glob("../works/0-*.jpg");
		foreach ($files as $file){
			$work_id = preg_replace("/.*-/","",$file);
			$work_id = preg_replace("/\.jpg/","",$work_id);
			rename($file, "../works/".$new_id."-".$work_id.".jpg");
		}
	}
}
mysql_close();
header("location:works.php");
?>
