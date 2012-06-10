<?php include("db.php");?>
<?php
if (isset($_POST["url"])){
	$url = $_POST["url"];
}
else{
	$url = "";
}

if (isset($_POST["description"])){
	$description = $_POST["description"];
}
else {
	$description = "";
}

$sql = "select max(id) as max_id from link;";
$result = $dbh->query($sql);
$row = $result->fetch();
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into link(id, url, description) values (\"".$new_id."\", \"".$url."\", \"".$description."\");";
$result = $dbh->query($sql);

$dbh = null;

header("Location: links.php");
?>
