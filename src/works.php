<?php
include("header.php");
include("mysql.php");


function get_next_topic($id_topic, $id_work, $last_work_in_topic){
	if($id_work == $last_work_in_topic)
		return $id_topic + 1;
	else
		return $id_topic;
}

function get_prev_topic($id_topic, $id_work){
	if($id_work == "1")
		return $id_topic - 1;
	else
		return $id_topic;
}

function get_next_work($id_work, $last_work_in_topic){
	if($id_work == $last_work_in_topic){
		return 1;
	}
	else{
		return $id_work + 1;
		
	}
}

function get_prev_work($id_work, $last_topic){
	if($id_work == "1"){
		$tmp = $last_topic-1;
		$sql = "select max(id) as max from work where topic=".$tmp.";";
		$result = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($result);
		$prev_work = $row["max"];
		return $prev_work;
	}
	else
		return $id_work - 1 ;
}

if (isset($_GET["topic"]))
	$id_topic = $_GET["topic"];
else
	$id_topic = 1;

if (isset($_GET["work"]))
	$id_work = $_GET["work"];
else
	$id_work = 1;

$sql = "select count(id) as count from work where topic = ".$id_topic.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$count_works = $row["count"];

# find last topic
$sql = "select max(id) as max from topic;";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$last_topic = $row["max"];

# if there is no topics don't go on
if ($last_topic == ""){
?>
This content is empty
<?
}
else {
    # find last work
    $sql = "select max(id) as max from work where topic=".$last_topic.";";
    $result = mysql_query($sql) or die (mysql_error());
    $row = mysql_fetch_assoc($result);
    $last_work = $row["max"];
    if ($last_work == ""){
?>
This content is empty
<?
    }
    else {
        # find last work in topic
        $sql = "select max(id) as max from work where topic=".$id_topic.";";
        $result = mysql_query($sql) or die (mysql_error());
        $row = mysql_fetch_assoc($result);
        $last_work_in_topic = $row["max"];


# menu topic
?>
<div id="works_menu">
<ul>
<?
$sql = "select * from topic order by id;";
$result = mysql_query($sql) or die (mysql_error());
while ($row = mysql_fetch_assoc($result)){
?>
<li>
<?
    // if selected topic, display another style
    if ($row["id"] == $id_topic) {
?>
<a href="works.php?topic=<?=$row["id"]?>" id="selected"><?=$row["name"]?></a>
<?
    }
    else {
?>
<a href="works.php?topic=<?=$row["id"]?>"><?=$row["name"]?></a>
<?
    }
}
?>
</li>
</ul>
</div>

<? #foto work ?>
<div id="work">
<?
// get Vimeo URL
$sql = "select vimeo_url from work where topic = $id_topic and id = ".$id_work.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
$vimeo_url = $row["vimeo_url"];

// if there is no Vimeo URL, then show picture
if ($vimeo_url == ""){
?>
<img src="<?=$config['works_dir'].'/'.$id_topic."-".$id_work.".jpg"?>" />
<?
}
// if there is a Vimeo URL, then show embedded player
else {
    $video_id = array_pop(explode("/", $vimeo_url));
?>
<iframe src="http://player.vimeo.com/video/<?=$video_id?>" width="500px" height="375" frameborder="0"></iframe>
<?
}
?>
</div>

<div id="works_navigation">

<? # description topic ?>
<div id="works_navigation_topic">
<?
$sql = "select description from topic where id = ".$id_topic.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
echo str_replace("\n", "<br />\n", $row["description"]);
?>
</div>

<? # navigation ?>
<div id="works_navigation_arrows">
<?

#first topic, first work
if($id_topic=="1" && $id_work=="1"){
?>
<img src="<?=$config['img_dir'].'/'.$config['icon_prev']?>" />
<?=$config['text_previous']?>
<?=$id_work?>/<?=$count_works?>
<a href="works.php?topic=<?=get_next_topic($id_topic, $id_work, $last_work_in_topic)?>&work=<?=get_next_work($id_work, $last_work_in_topic);?>">
<?=$config['text_next']?>
</a>
<a href="works.php?topic=<?=get_next_topic($id_topic, $id_work, $last_work_in_topic)?>&work=<?=get_next_work($id_work, $last_work_in_topic);?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_next']?>" />
</a>

<?
}
#last topic, last work
elseif($id_topic==$last_topic && $id_work==$last_work){
?>
<a href="works.php?topic=<?=get_prev_topic($id_topic, $id_work)?>&work=<?=get_prev_work($id_work, $id_topic)?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_prev']?>" />
</a>
<a href="works.php?topic=<?=get_prev_topic($id_topic, $id_work)?>&work=<?=get_prev_work($id_work, $id_topic)?>">
<?=$config['text_prev']?>
</a>
<?=$id_work?>/<?=$count_works?>
<?=$config['text_next']?>
<img src="<?=$config['img_dir'].'/'.$config['icon_next']?>" />
<?
}

# normal
else{
?>
<a href="works.php?topic=<?=get_prev_topic($id_topic, $id_work)?>&work=<?=get_prev_work($id_work, $id_topic)?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_prev']?>" />
</a>
<a href="works.php?topic=<?=get_prev_topic($id_topic, $id_work)?>&work=<?=get_prev_work($id_work, $id_topic)?>">
<?=$config['text_prev']?>
</a>
<?=$id_work?>/<?=$count_works?>
<a href="works.php?topic=<?=get_next_topic($id_topic, $id_work, $last_work_in_topic)?>&work=<?=get_next_work($id_work, $last_work_in_topic);?>">
<?=$config['text_next']?>
</a>
<a href="works.php?topic=<?=get_next_topic($id_topic, $id_work, $last_work_in_topic)?>&work=<?=get_next_work($id_work, $last_work_in_topic);?>">
<img src="<?=$config['img_dir'].'/'.$config['icon_next']?>" />
</a>

<?
}
?>

</div>


<? # title work ?>
<div id="works_navigation_title">
<?
$sql = "select title from work where id = ".$id_work." and topic = ".$id_topic.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
echo $row["title"];
?>
</div>

<? # description work ?>
<div id="works_navigation_description">
<?
$sql = "select description from work where id = ".$id_work." and topic = ".$id_topic.";";
$result = mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_assoc($result);
echo str_replace("\n", "<br />\n", $row["description"]);
?>
</div>

</div>

<?php
    }
}
include("footer.php");
?>
