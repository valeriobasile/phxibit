<?php include("mysql.php");?>
<?php
if (isset($_POST["name"])){
	$name = $_POST["name"];
}
else{
	$name = "";
}


$sql = "select max(id) as max_id from category;";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into category(id, name) values (\"".$new_id."\", \"".$name."\");";
$result = mysql_query($sql) or die (mysql_error());

mysql_close();

header("Location: publications.php?category=".$new_id);
?>
