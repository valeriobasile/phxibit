<?php include("mysql.php");?>
<?php
if (isset($_GET["category"]) && isset($_GET["publication"])){
	$category_id = $_GET["category"];
	$publication_id = $_GET["publication"];
	$picture_dir = "../publications/";
	
	$sql = "delete from publication where category = ".$category_id." and id = ".$publication_id.";";
	mysql_query($sql) or die (mysql_error());
	unlink($picture_dir.$category_id."-".$publication_id.".jpg");
	
	$sql = "select id from publication where category = ".$category_id." and id > ".$publication_id." order by id;";
	$result = mysql_query($sql) or die (mysql_error());
	while ($row = mysql_fetch_assoc($result)){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update publication set id = ".$new_id." where category = ".$category_id." and id = ".$old_id.";";
		mysql_query($sql) or die (mysql_error());
		try{
			rename($picture_dir.$category_id."-".$old_id.".jpg", $picture_dir.$category_id."-".$new_id.".jpg");
		}
		catch(exception $e){}
	}
}
mysql_close();
header("location:publications.php?category=".$category_id);
?>
