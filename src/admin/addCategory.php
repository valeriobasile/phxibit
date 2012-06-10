<?php include("db.php");?>
<?php
if (isset($_POST["name"])){
	$name = $_POST["name"];
}
else{
	$name = "";
}


$sql = "select max(id) as max_id from category;";
$result = $dbh->query($sql);
$row = $result->fetch();
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into category(id, name) values (\"".$new_id."\", \"".$name."\");";
$result = $dbh->query($sql);

$dbh = null;

header("Location: publications.php?category=".$new_id);
?>
