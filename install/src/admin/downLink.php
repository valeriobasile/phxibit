<?php include("db.php");?>
<?php
if (isset($_GET["link"])){
	$id = $_GET["link"];

	if ($id>1){
		$new_id = $id - 1;

		# 0 is used as temp id
		$sql = "update link set id = 0 where id = ".$id.";";
		$dbh->query($sql);
		
		$sql = "update link set id = ".$id." where id = ".$new_id.";";
		$dbh->query($sql);
		
		$sql = "update link set id = ".$new_id." where id = 0;";
		$dbh->query($sql);
	}
}
$dbh = null;
header("location:links.php");
?>
