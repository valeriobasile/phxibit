<?php
include("header.php");
include("mysql.php");
?>


<?php

if (isset($_GET["exhibition"]))
	$id_exhibition = $_GET["exhibition"];
else
	$id_exhibition = 1;



# static description
?>
		<div id="contentMenu">
		  <div id="bio">
			  <h1>Katharina Dieckhoff</h1>
			  <br />
			March,8th 1976<br />Maastricht (NL).<br /> German nationality, in Italy (Bologna) since 1995.<br /><br />
2005 Master in History of Arts at the University of Bologna.<br />2003 Master in Painting at the Academy of Fine Arts of Bologna.<br />Artistic stays at New York and Berlin. <br /></div>
		</div>



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

<!-- (disabled) right bar with picture related to selected exhibition 
<div id="contentBoxR">
	<div id="imgExhibition">
<?
$sql = "select title from exhibition where id = ".$id_exhibition.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
echo str_replace("\n", "<br />\n", $row["title"]);
?>
				  <br />
		  <img src="<?=$DIR_EXHIBITIONS.$id_exhibition.".jpg"?>" />
	</div>
</div>
-->

<?php
include("footer.php");
?>
