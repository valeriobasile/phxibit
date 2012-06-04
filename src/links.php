<?php
include("header.php");
include("mysql.php");

#link list ?>
<div id="links">
<?
$sql = "select * from link;";
$result = mysql_query($sql) or die (mysql_error());
while ($row = mysql_fetch_assoc($result)){
	echo ("<span id=\"link_url\"><a href=\"".$row["url"]."\" target=\"_blank\">".$row["url"]."</a></span>");
	echo ("<span id=\"link_description\">".$row["description"]."</span>\n");
}
?>
</div>


<?php
include("footer.php");
?>
