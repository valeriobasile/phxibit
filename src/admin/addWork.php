<?php include("mysql.php");?>
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
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into work(id, topic, title, description, vimeo_url) values (\"".$new_id."\", \"".$id_topic."\", \"".$name."\", \"".$description."\", \"".$vimeo_url."\");";
$result = mysql_query($sql) or die (mysql_error());

mysql_close();

$picture_dir = "../works/";
copy($picture_dir."dummy.jpg", $picture_dir.$id_topic."-".$new_id.".jpg");

header("Location: works.php?topic=".$id_topic);
?>
