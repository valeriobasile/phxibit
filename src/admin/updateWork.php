<?php include("header.php");?>
<?php
if (isset($_GET["topic"]) && isset($_GET["work"])){
	$id_topic = $_GET["topic"];
	$id_work = $_GET["work"];

	$sql = "select * from work where topic = ".$id_topic." and id = ".$id_work.";";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	$title = $row["title"];
	$description = $row["description"];
	$vimeo_url = $row["vimeo_url"];
?>
<form action="confirmUpdateWork.php" method="post" />
<input type="hidden" name="id" value="<?=$id_work?>" />
<input type="hidden" name="topic" value="<?=$id_topic?>" />
<input type="text" name="title" len="100" value="<?=str_replace("\"", "&quot;", $title)?>" />
<br/>
<textarea name="description"><?=$description?></textarea>
<br/>
(video) Vimeo URL:<br/>
<input  id="textbox" type="text" name="vimeo_url" len="100" value="<?=$vimeo_url?>" />
<br/>
<input type="submit" value="save" />
</form>
<?
}
?>
<?php include("footer.php");?>

