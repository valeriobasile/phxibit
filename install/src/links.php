<?php
include("header.php");
include("db.php");

#link list ?>
<div id="links">
<?
$sql = "select * from link;";
$result = $dbh->query($sql);
while ($row = $result->fetch()){
	echo ("<span id=\"link_url\"><a href=\"".$row["url"]."\" target=\"_blank\">".$row["url"]."</a></span>");
	echo ("<span id=\"link_description\">".$row["description"]."</span>\n");
}
?>
</div>


<?php
include("footer.php");
?>
