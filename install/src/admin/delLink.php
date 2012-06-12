<?php include("db.php");?>
<?php
if (isset($_GET["link"])){
	$id = $_GET["link"];

	$sql = "delete from link where id = ".$id.";";
	$dbh->query($sql);
	
	$sql = "select id from link where id > ".$id." order by id;";
	$result = $dbh->query($sql);
	while ($row = $result->fetch()){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update link set id = ".$new_id." where id = ".$old_id.";";
		$dbh->query($sql);
	}

}
$dbh = null;
header("location:links.php");
?>
