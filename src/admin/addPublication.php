<?php include("mysql.php");?>
<?php

if (isset($_POST["category"])){
	$id_category = $_POST["category"];
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

if (isset($_POST["text"])){
	$text = $_POST["text"];
}
else {
	$text = "";
}

$sql = "select max(id) as max_id from publication where category = ".$id_category.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into publication(id, category, title, description, text) values (\"".$new_id."\", \"".$id_category."\", \"".$name."\", \"".$description."\", \"".$text."\");";
$result = mysql_query($sql) or die (mysql_error());

mysql_close();

$picture_dir = "../publications/";
copy($picture_dir."dummy.jpg", $picture_dir.$id_category."-".$new_id.".jpg");

header("Location: publications.php?category=".$id_category);
?>
