<?php include("mysql.php");?>
<?php
if (isset($_POST["name"])){
	$name = $_POST["name"];
}
else{
	$name = "";
}

if (isset($_POST["description"])){
	$description = $_POST["description"];
}
else {
	$description = "";
}

$sql = "select max(id) as max_id from topic;";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into topic(id, name, description) values (\"".$new_id."\", \"".$name."\", \"".$description."\");";
$result = mysql_query($sql) or die (mysql_error());

mysql_close();

header("Location: works.php?topic=".$new_id);
?>
