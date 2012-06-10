<?php include("db.php");?>
<?php
if (isset($_GET["category"]) && isset($_GET["publication"])){
	$id_category = $_GET["category"];
	$id_publication = $_GET["publication"];
	$picture_dir = "../publications/";

	$sql = "select max(id) as max_id from publication where category = ".$id_category.";";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	$max_id = $row["max_id"];

	if ($id_publication < $max_id){
		$new_id = $id_publication + 1;

		# 0 is used as temp id
		$sql = "update publication set id = 0 where category = ".$id_category." and id = ".$id_publication.";";
		$dbh->query($sql);
		rename($picture_dir.$id_category."-".$id_publication.".jpg", $picture_dir.$id_category."-0.jpg");

		$sql = "update publication set id = ".$id_publication." where category = ".$id_category." and id = ".$new_id.";";
		$dbh->query($sql);
		rename($picture_dir.$id_category."-".$new_id.".jpg", $picture_dir.$id_category."-".$id_publication.".jpg");

		$sql = "update publication set id = ".$new_id." where category = ".$id_category." and id = 0;";
		$dbh->query($sql);
		rename($picture_dir.$id_category."-0.jpg", $picture_dir.$id_category."-".$new_id.".jpg");
	}
}
$dbh = null;
//Set no caching
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");header("location:publications.php?category=".$id_category);
?>
