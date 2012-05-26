<?php include("mysql.php");?>
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
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$max_id = $row["max_id"];
$new_id = $max_id + 1;

$sql = "insert into exhibition(id, title, description) values (\"".$new_id."\", \"".$title."\", \"".$description."\");";
$result = mysql_query($sql) or die (mysql_error());

mysql_close();

$picture_dir = "../exhibitions/";
copy($picture_dir."dummy.jpg", $picture_dir.$new_id.".jpg");

header("Location: exhibitions.php");
?>
