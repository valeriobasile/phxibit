<?php
include("header.php");
include("mysql.php");
?>


<?php

# menu category
?>
<div id="contentMenu">
	<div id="menu"></div>
</div>

<? #link list ?>
<div id="contentBoxL">
<?
$sql = "select * from link;";
$result = mysql_query($sql) or die (mysql_error());
while ($row = mysql_fetch_assoc($result)){
	echo ("<span id=\"linkTitle\">".$row["description"]."</span>\n");
	echo ("<span id=\"linkText\"><a href=\"".$row["url"]."\" target=\"_blank\">".$row["url"]."</a></span><br />");
}
?>
</div>

<div id="contentBoxR">
	<div id="descripTopic"></div>
	<div id="arrows"></div>
	<div id="titleWork"></div>
	<div id="descripWork"></div>
</div>



<?php
include("footer.php");
?>
