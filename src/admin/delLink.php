<?php include("mysql.php");?>
<?php
if (isset($_GET["link"])){
	$id = $_GET["link"];

	$sql = "delete from link where id = ".$id.";";
	mysql_query($sql) or die (mysql_error());
	
	$sql = "select id from link where id > ".$id." order by id;";
	$result = mysql_query($sql) or die (mysql_error());
	while ($row = mysql_fetch_assoc($result)){
		$old_id = $row["id"];
		$new_id = $row["id"] - 1;
		$sql = "update link set id = ".$new_id." where id = ".$old_id.";";
		mysql_query($sql) or die (mysql_error());
	}

}
mysql_close();
header("location:links.php");
?>
