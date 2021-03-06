<?php
include("header.php");
include("db.php");

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

function get_prev_publication($id_publication, $last_category, $dbh){
	if($id_publication == "1"){
		$sql = "select max(id) as max from publication where category=".$last_category."-1;";
		$result = $dbh->query($sql);
		$row = $result->fetch();
		$prev_publication = $row["max"];
		return $prev_publication;
	}
	else
		return $id_publication - 1 ;
}

if (isset($_GET["category"]))
	$id_category = $_GET["category"];
else
	$id_category = 1;

if (isset($_GET["publication"]))
	$id_publication = $_GET["publication"];
else
	$id_publication = 1;

$sql = "select count(id) as count from publication where category = ".$id_category.";";
$result = $dbh->query($sql);
$row = $result->fetch();
$count_publications = $row["count"];

# find last category
$sql = "select max(id) as max from category;";
$result = $dbh->query($sql);
$row = $result->fetch();
$last_category = $row["max"];

# if there is no publication don't go on
if ($last_category == ""){
?>
This content is empty
<?
}
else {
    # find last publication
    $sql = "select max(id) as max from publication where category=".$last_category.";";
    $result = $dbh->query($sql);
    $row = $result->fetch();
    $last_publication = $row["max"];
    
    if ($last_publication == ""){
    ?>
    This content is empty
    <?
    }
    else {
        # find last publication in category
        $sql = "select max(id) as max from publication where category=".$id_category.";";
        $result = $dbh->query($sql);
        $row = $result->fetch();
        $last_publication_in_category = $row["max"];

# menu category
?>
<div id="publications_menu">
	<ul>
	<?
	$sql = "select * from category order by id;";
	$result = $dbh->query($sql);
	while ($row = $result->fetch()){
	?>
	<li>
	    <a href="publications.php?category=<?=$row["id"]?>"><?=$row["name"]?></a>
	</li>
	<?
	}
	?>
	</ul>
</div>

<? #foto publication ?>
<div id="publication">
<?
if ($id_category=="3") {
	$sql = "select title from publication where id = ".$id_publication." and category = ".$id_category.";";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	echo $row["title"];
}
?>
<img src="<?=$config['publications_dir'].'/'.$id_category."-".$id_publication.".jpg"?>" />
<br />
<br />
<?
$sql = "select text from publication where id = ".$id_publication." and category = ".$id_category.";";
$result = $dbh->query($sql);
$row = $result->fetch();

echo str_replace("\n", "<br />\n", $row["text"]);
?>
</div>

<div id="publication_navigation">

<? # frecce di navigazione ?>
<div id="publication_navigation_arrows">
<?

#first category, first publication
if($id_category=="1" && $id_publication=="1"){
?>
<img src="<?=$config['img_dir'].'/'.$config['icon_prev']?>" />
<?=$config['text_prev']?>
<?=$id_publication?>/<?=$count_publications?>
<a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
<?=$config['text_next']?>
</a><a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_next']?>" />
</a>

<?
}
#last category, last publication
elseif($id_category==$last_category && $id_publication==$last_publication){
?>
<a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category, $dbh)?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_prev']?>" />
</a><a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category, $dbh)?>">
<?=$config['text_prev']?>
</a>
<?=$id_publication?>/<?=$count_publications?>
<?=$config['text_next']?>
<img src="<?=$config['img_dir'].'/'.$config['icon_next']?>" />
<?
}

# normal
else{
?>
<a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category, $dbh)?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_prev']?>" />
</a><a href="publications.php?category=<?=get_prev_category($id_category, $id_publication)?>&publication=<?=get_prev_publication($id_publication, $id_category, $dbh)?>">
<?=$config['text_prev']?>
</a>
<?=$id_publication?>/<?=$count_publications?>
<a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
<?=$config['text_next']?>
</a><a href="publications.php?category=<?=get_next_category($id_category, $id_publication, $last_publication_in_category)?>&publication=<?=get_next_publication($id_publication, $last_publication_in_category);?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_next']?>" />
</a>

<?
}
?>


</div>


<? # title publication ?>
<div id="publication_navigation_title">
<?
$sql = "select title from publication where id = ".$id_publication." and category = ".$id_category.";";
$result = $dbh->query($sql);
$row = $result->fetch();
echo $row["title"];
?>
</div>

<? # description publication ?>
<div id="publication_navigation_description">
<?
$sql = "select description from publication where id = ".$id_publication." and category = ".$id_category.";";
$result = $dbh->query($sql);
$row = $result->fetch();
$description = $row["description"];
echo str_replace("\n", "<br />\n", $description);
?>
</div>

</div>

<?php
    }
}
include("footer.php");
?>
