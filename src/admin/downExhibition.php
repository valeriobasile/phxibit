<?php include("db.php");?>
<?php
if (isset($_GET["exhibition"])){
	$id = $_GET["exhibition"];

	if ($id>1){
		$new_id = $id - 1;

		# 0 is used as temp id
		$sql = "update exhibition set id = 0 where id = ".$id.";";
		$dbh->query($sql);
		rename("../exhibitions/".$id.".jpg", "../exhibitions/0.jpg");

		$sql = "update exhibition set id = ".$id." where id = ".$new_id.";";
		$dbh->query($sql);
		rename("../exhibitions/".$new_id.".jpg", "../exhibitions/".$id.".jpg");

		$sql = "update exhibition set id = ".$new_id." where id = 0;";
		$dbh->query($sql);
		rename("../exhibitions/0.jpg", "../exhibitions/".$new_id.".jpg");
	}
}
$dbh = null;
header("location:exhibitions.php");
?>
