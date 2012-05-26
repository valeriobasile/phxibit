<?php
include("header.php");
include("mysql.php");
?>


<?php
if (isset($_GET["category"]))
	$id_category = $_GET["category"];
else
	$id_category = 1;

if (isset($_GET["publication"]))
	$id_publication = $_GET["publication"];
else
	$id_publication = 1;

$sql = "select count(id) as count from publication where category = ".$id_category.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$count_publications = $row["count"];

# find last category
$sql = "select max(id) as max from category;";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$last_category = $row["max"];

# find last publication
$sql = "select max(id) as max from publication where category=".$last_category.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$last_publication = $row["max"];

# find last publication in category
$sql = "select max(id) as max from publication where category=".$id_category.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$last_publication_in_category = $row["max"];



function get_next_category($id_category, $id_publication, $last_publication_in_category){
	if($id_publication == $last_publication_in_category)
		return $id_category + 1;
	else
		return $id_category;
}

function get_prev_category($id_category, $id_publication){
	if($id_publication == "1")
		return $id_category - 1;
	else
		return $id_category;
}

function get_next_publication($id_publication, $last_publication_in_category){
	if($id_publication == $last_publication_in_category){
		return 1;
	}
	else{
		return $id_publication + 1;
		
	}
}

function get_prev_publication($id_publication, $last_category){
	if($id_publication == "1"){
		$sql = "select max(id) as max from publication where category=".$last_category."-1;";
		$result = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($result);
		$prev_publication = $row["max"];
		return $prev_publication;
	}
	else
		return $id_publication - 1 ;
}

# menu category
?>
<div id="contentMenu">
	<div id="menu">
		<ul>
		<?
		$sql = "select * from category order by id;";
		$result = mysql_query($sql) or die (mysql_error());
		while ($row = mysql_fetch_assoc($result)){
		?>
		<li>
		<a href="publications.php?category=<?=$row["id"]?>"><?=$row["name"]?></a>
		</li>
		<?
		}
		?>
		</ul>
	</div>
</div>

<? #foto publication ?>
<div id="contentBoxL">
<div id="titleWork">
<?
if ($id_category=="3") {
	$sql = "select title from publication where id = ".$id_publication." and category = ".$id_category.";";
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
	echo $row["title"];
}
?>
</div>

<a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
<img src="<?=$DIR_PUBLICATIONS.$id_category."-".$id_publication.".jpg"?>" />
</a>
<br />
<br />
<?
$sql = "select text from publication where id = ".$id_publication." and category = ".$id_category.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);

echo str_replace("\n", "<br />\n", $row["text"]);
?>
</div>

<div id="contentBoxR">

<div id="descripTopic"></div>
<? # frecce di navigazione ?>
<div id="arrows">
<?

#first category, first publication
if($id_category=="1" && $id_publication=="1"){
?>
<img src="icone/prev.png" />
prev
<?=$id_publication?>/<?=$count_publications?>
<a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
next
</a>
<a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
<img src="icone/next.png" />
</a>

<?
}
#last category, last publication
elseif($id_category==$last_category && $id_publication==$last_publication){
?>
<a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category)?>">
<img src="icone/prev.png" />
</a>
<a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category)?>">
prev
</a>
<?=$id_publication?>/<?=$count_publications?>

next
<img src="icone/next.png" />
<?
}

# normal
else{
?>
<a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category)?>">
<img src="icone/prev.png" />
</a>
<a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category)?>">
prev
</a>
<?=$id_publication?>/<?=$count_publications?>
<a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
next
</a>
<a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
<img src="icone/next.png" />
</a>

<?
}
?>


</div>


<? # title publication ?>
<div id="titleWork">
<?
$sql = "select title from publication where id = ".$id_publication." and category = ".$id_category.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
echo $row["title"];
?>
</div>

<? # description publication ?>
<div id="descripWork">
<?
$sql = "select description from publication where id = ".$id_publication." and category = ".$id_category.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$description = $row["description"];
echo str_replace("\n", "<br />\n", $description);
?>
</div>



</div>



<?php
include("footer.php");
?>
