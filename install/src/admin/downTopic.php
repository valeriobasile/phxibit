<?php include("db.php");?>
<?php
if (isset($_GET["topic"])){
	$id = $_GET["topic"];

	if ($id>1){
		$new_id = $id - 1;

		# 0 is used as temp id
		$sql = "update topic set id = 0 where id = ".$id.";";
		$dbh->query($sql);
		$sql = "update work set topic = 0 where topic = ".$id.";";
		$dbh->query($sql);
	
		$files = glob("../works/".$id."-*.jpg");
		foreach ($files as $file){
			$work_id = preg_replace("/.*-/","",$file);
			$work_id = preg_replace("/\.jpg/","",$work_id);
			rename($file, "../works/0-".$work_id.".jpg");
		}

		$sql = "update topic set id = ".$id." where id = ".$new_id.";";
		$dbh->query($sql);
		$sql = "update work set topic = ".$id." where topic = ".$new_id.";";
		$dbh->query($sql);

		$files = glob("../works/".$new_id."-*.jpg");
		foreach ($files as $file){
			$work_id = preg_replace("/.*-/","",$file);
			$work_id = preg_replace("/\.jpg/","",$work_id);
			rename($file, "../works/".$id."-".$work_id.".jpg");
		}

		$sql = "update topic set id = ".$new_id." where id = 0;";
		$dbh->query($sql);
		$sql = "update work set topic = ".$new_id." where topic = 0;";
		$dbh->query($sql);

		$files = glob("../works/0-*.jpg");
		foreach ($files as $file){
			$work_id = preg_replace("/.*-/","",$file);
			$work_id = preg_replace("/\.jpg/","",$work_id);
			rename($file, "../works/".$new_id."-".$work_id.".jpg");
		}
	}
}
$dbh = null;
header("location:works.php");
?>
