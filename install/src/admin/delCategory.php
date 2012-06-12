<?php include("db.php");?>
<?php
if (isset($_GET["category"])){
	$id = $_GET["category"];

	$sql = "delete from category where id = ".$id.";";
	$dbh->query($sql);
	
	$sql = "delete from publication where category = ".$id.";";
	$dbh->query($sql);
	
	$files = glob("../publications/".$id."-*.jpg");
	array_map('unlink', $files);

	$sql = "select id from category where id > ".$id." order by id;";
	$result = $dbh->query($sql);
	while ($row = $result->fetch()){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update category set id = ".$new_id." where id = ".$old_id.";";
		$dbh->query($sql);
		$sql = "update publication set category = ".$new_id." where category = ".$old_id.";";
		$dbh->query($sql);
		
		$files = glob("../publications/".$old_id."-*.jpg");
		foreach ($files as $file){
			$publication_id = preg_replace("/.*-/","",$file);
			$publication_id = preg_replace("/\.jpg/","",$publication_id);
			rename($file, "../publications/".$new_id."-".$publication_id.".jpg");
		}
	}

	$sql = "select id from category where id = ".$id." order by id;";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	$old_id = $row["id"];
	$new_id = $row["id"] - 1;

	$files = glob("../publications/".$old_id."-*.jpg");
	foreach ($files as $file){
		$publication_id = preg_replace("/.*-/","",$file);
		$publication_id = preg_replace("/\.jpg/","",$publication_id);
		rename($file, "../publications/".$old_id."-".$publication_id.".jpg");
	}

}
$dbh = null;
header("location:publications.php");
?>
