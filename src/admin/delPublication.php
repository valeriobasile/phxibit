<?php include("db.php");?>
<?php
if (isset($_GET["category"]) && isset($_GET["publication"])){
	$category_id = $_GET["category"];
	$publication_id = $_GET["publication"];
	$picture_dir = "../publications/";
	
	$sql = "delete from publication where category = ".$category_id." and id = ".$publication_id.";";
	$dbh->query($sql);
	unlink($picture_dir.$category_id."-".$publication_id.".jpg");
	
	$sql = "select id from publication where category = ".$category_id." and id > ".$publication_id." order by id;";
	$result = $dbh->query($sql);
	while ($row = $result->fetch()){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update publication set id = ".$new_id." where category = ".$category_id." and id = ".$old_id.";";
		$dbh->query($sql);
		try{
			rename($picture_dir.$category_id."-".$old_id.".jpg", $picture_dir.$category_id."-".$new_id.".jpg");
		}
		catch(exception $e){}
	}
}
$dbh = null;
header("location:publications.php?category=".$category_id);
?>
