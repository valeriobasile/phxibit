<?php include("mysql.php");?>
<?php
if (isset($_GET["exhibition"])){
	$id = $_GET["exhibition"];

	if ($id>1){
		$new_id = $id - 1;

		# 0 is used as temp id
		$sql = "update exhibition set id = 0 where id = ".$id.";";
		mysql_query($sql) or die (mysql_error());
		rename("../exhibitions/".$id.".jpg", "../exhibitions/0.jpg");

		$sql = "update exhibition set id = ".$id." where id = ".$new_id.";";
		mysql_query($sql) or die (mysql_error());
		rename("../exhibitions/".$new_id.".jpg", "../exhibitions/".$id.".jpg");

		$sql = "update exhibition set id = ".$new_id." where id = 0;";
		mysql_query($sql) or die (mysql_error());
		rename("../exhibitions/0.jpg", "../exhibitions/".$new_id.".jpg");
	}
}
mysql_close();
header("location:exhibitions.php");
?>
