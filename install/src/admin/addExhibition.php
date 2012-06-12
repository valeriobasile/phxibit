<?php include("db.php");?>
<?php
if (isset($_POST["title"])){
	$title = $_POST["title"];
}
else{
	$title = "";
}

if (isset($_POST["description"])){
	$description = $_POST["description"];
}
else {
	$description = "";
}

$sql = "select max(id) as max_id from exhibition;";
$result = $dbh->query($sql);
$row = $result->fetch();
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into exhibition(id, title, description) values (\"".$new_id."\", \"".$title."\", \"".$description."\");";
$result = $dbh->query($sql);

$dbh = null;

$picture_dir = "../".$config["exhibitions_dir"]."/";
copy($picture_dir."dummy.jpg", $picture_dir.$new_id.".jpg") or die;

header("Location: exhibitions.php");
?>
