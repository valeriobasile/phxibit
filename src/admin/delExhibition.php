<?php include("mysql.php");?>
<?php
if (isset($_GET["exhibition"])){
	$id = $_GET["exhibition"];

	$sql = "delete from exhibition where id = ".$id.";";
	mysql_query($sql) or die (mysql_error());
	
	unlink("../exhibitions/".$id.".jpg");
	
	$sql = "select id from exhibition where id > ".$id." order by id;";
	$result = mysql_query($sql) or die (mysql_error());
	while ($row = mysql_fetch_assoc($result)){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update exhibition set id = ".$new_id." where id = ".$old_id.";";
		mysql_query($sql) or die (mysql_error());
	}

}
mysql_close();
header("location:exhibitions.php");
?>
