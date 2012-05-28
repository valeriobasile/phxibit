<?php
include("header.php");

if (isset($_GET["exhibition"]))
	$id_exhibition = $_GET["exhibition"];
else
	$id_exhibition = 1;
?>
<?php
include($config['static_dir']."/".$config['biography_file']);
?>
<? #exhibition list?>
<div id="contentBoxL">
<?
$sql = "select * from exhibition order by id;";
$result = mysql_query($sql) or die (mysql_error());
while ($row = mysql_fetch_assoc($result)){
    // (disabled) link to show related pic in the right bar
	// echo ("<span id=\"exhibitionTitle\"><a href=\"exhibitions.php?exhibition=".$row["id"]."\">".$row["title"]."</a></span>\n");
	echo ("<span id=\"exhibitionTitle\">".$row["title"]."</span>\n");
	echo ("<span id=\"exhibitionText\">".$row["description"]."</span><br />");
}
?>
</div>
<?php
include("footer.php");
?>
