<?php include("db.php");?>
<?php

if (isset($_POST["topic"])){
	$id_topic = $_POST["topic"];
}
if (isset($_POST["title"])){
	$name = $_POST["title"];
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

if (isset($_POST["vimeo_url"])){
	$vimeo_url = $_POST["vimeo_url"];
}
else {
	$vimeo_url = "";
}

$sql = "select max(id) as max_id from work where topic = ".$id_topic.";";
$result = $dbh->query($sql);
if ($result){
    $row = $result->fetch();
    $max_id = $row["max_id"];
    $new_id = $max_id + 1;
}
else {
    $new_id = 1;
}
$sql = "insert into work(id, topic, title, description, vimeo_url) values (\"".$new_id."\", \"".$id_topic."\", \"".$name."\", \"".$description."\", \"".$vimeo_url."\");";
$result = $dbh->query($sql);

$dbh = null;

$picture_dir = "../".$config["works_dir"]."/";
copy($picture_dir."dummy.jpg", $picture_dir.$id_topic."-".$new_id.".jpg");

header("Location: works.php?topic=".$id_topic);
?>
