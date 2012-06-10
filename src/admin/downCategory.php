<?php include("db.php");?>
<?php
if (isset($_GET["category"])){
	$id = $_GET["category"];

	if ($id>1){
		$new_id = $id - 1;

		# 0 is used as temp id
		$sql = "update category set id = 0 where id = ".$id.";";
		$dbh->query($sql);
		$sql = "update publication set category = 0 where category = ".$id.";";
		$dbh->query($sql);
	
		$files = glob("../publications/".$id."-*.jpg");
		foreach ($files as $file){
			$publication_id = preg_replace("/.*-/","",$file);
			$publication_id = preg_replace("/\.jpg/","",$publication_id);
			rename($file, "../publications/0-".$publication_id.".jpg");
		}

		$sql = "update category set id = ".$id." where id = ".$new_id.";";
		$dbh->query($sql);
		$sql = "update publication set category = ".$id." where category = ".$new_id.";";
		$dbh->query($sql);

		$files = glob("../publications/".$new_id."-*.jpg");
		foreach ($files as $file){
			$publication_id = preg_replace("/.*-/","",$file);
			$publication_id = preg_replace("/\.jpg/","",$publication_id);
			rename($file, "../publications/".$id."-".$publication_id.".jpg");
		}

		$sql = "update category set id = ".$new_id." where id = 0;";
		$dbh->query($sql);
		$sql = "update publication set category = ".$new_id." where category = 0;";
		$dbh->query($sql);

		$files = glob("../publications/0-*.jpg");
		foreach ($files as $file){
			$publication_id = preg_replace("/.*-/","",$file);
			$publication_id = preg_replace("/\.jpg/","",$publication_id);
			rename($file, "../publications/".$new_id."-".$publication_id.".jpg");
		}
	}
}
$dbh = null;
header("location:publications.php");
?>
