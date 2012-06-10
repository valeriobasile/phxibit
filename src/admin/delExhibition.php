<?php include("db.php");?>
<?php
if (isset($_GET["exhibition"])){
	$id = $_GET["exhibition"];

	$sql = "delete from exhibition where id = ".$id.";";
	$dbh->query($sql);
	
	unlink("../exhibitions/".$id.".jpg");
	
	$sql = "select id from exhibition where id > ".$id." order by id;";
	$result = $dbh->query($sql);
	while ($row = $result->fetch()){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update exhibition set id = ".$new_id." where id = ".$old_id.";";
		$dbh->query($sql);
	}

}
$dbh = null;
header("location:exhibitions.php");
?>
