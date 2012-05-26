<?php include("mysql.php");?>
<?php
if (isset($_GET["link"])){
	$id = $_GET["link"];

	$sql = "select max(id) as max_id from link;";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$max_id = $row["max_id"];

	if ($id < $max_id){
		$new_id = $id + 1;

		# 0 is used as temp id
		$sql = "update link set id = 0 where id = ".$id.";";
		mysql_query($sql) or die (mysql_error());
		
		$sql = "update link set id = ".$id." where id = ".$new_id.";";
		mysql_query($sql) or die (mysql_error());
		
		$sql = "update link set id = ".$new_id." where id = 0;";
		mysql_query($sql) or die (mysql_error());
	}
}
mysql_close();
header("location:links.php");
?>
