<?php include("mysql.php");?>
<?php
if (isset($_GET["category"])){
	$id = $_GET["category"];

	$sql = "delete from category where id = ".$id.";";
	mysql_query($sql) or die (mysql_error());
	
	$sql = "delete from publication where category = ".$id.";";
	mysql_query($sql) or die (mysql_error());
	
	$files = glob("../publications/".$id."-*.jpg");
	array_map('unlink', $files);

	$sql = "select id from category where id > ".$id." order by id;";
	$result = mysql_query($sql) or die (mysql_error());
	while ($row = mysql_fetch_assoc($result)){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update category set id = ".$new_id." where id = ".$old_id.";";
		mysql_query($sql) or die (mysql_error());
		$sql = "update publication set category = ".$new_id." where category = ".$old_id.";";
		mysql_query($sql) or die (mysql_error());
		
		$files = glob("../publications/".$old_id."-*.jpg");
		foreach ($files as $file){
			$publication_id = preg_replace("/.*-/","",$file);
			$publication_id = preg_replace("/\.jpg/","",$publication_id);
			rename($file, "../publications/".$new_id."-".$publication_id.".jpg");
		}
	}

	$sql = "select id from category where id = ".$id." order by id;";
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
	$old_id = $row["id"];
	$new_id = $row["id"] - 1;

	$files = glob("../publications/".$old_id."-*.jpg");
	foreach ($files as $file){
		$publication_id = preg_replace("/.*-/","",$file);
		$publication_id = preg_replace("/\.jpg/","",$publication_id);
		rename($file, "../publications/".$old_id."-".$publication_id.".jpg");
	}

}
mysql_close();
header("location:publications.php");
?>
