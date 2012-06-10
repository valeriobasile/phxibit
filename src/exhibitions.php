<?php
include("header.php");

if (isset($_GET["exhibition"]))
	$id_exhibition = $_GET["exhibition"];
else
	$id_exhibition = 1;

#exhibition list?>
<div id="exhibitions">
<?
$sql = "select * from exhibition order by id;";
$result = $dbh->query($sql);
while ($row = $result->fetch()){
?>
<div id="exhibition">
    <img src="<?=$config['exhibitions_dir']?>/<?=$row['id']?>.jpg" />
    <div id="exhibitions_navigation">
	    <div id="exhibitions_navigation_title"><?=$row["title"]?></div>
	    <div id="exhibitions_navigation_description"><?=$row["description"]?></div>
    </div>
</div>
<?
}
?>
</div>
<?php
include("footer.php");
?>
