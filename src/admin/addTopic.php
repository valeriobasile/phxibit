<?php include("db.php");?>
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
$result = $dbh->query($sql);
$row = $result->fetch();
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into topic(id, name, description) values (\"".$new_id."\", \"".$name."\", \"".$description."\");";
$result = $dbh->query($sql);

$dbh = null;

header("Location: works.php?topic=".$new_id);
?>
