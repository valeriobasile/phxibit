<?php include("header.php");?>
<?php
$sql = "select * from topic order by id;";
$result = mysql_query($sql) or die (mysql_error());
?>
<div class="box">
<h1>Topic</h1>
<table>
<thead>
<tr>
<th>Topic</th>
<th>Description</th>
<th>Update</th>
<th>Delete</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
while ($row = mysql_fetch_assoc($result)){
?>
<tr>
<td><a href="works.php?topic=<?=$row["id"]?>"><?=$row["name"]?></a></td>
<td><?=$row["description"]?></td>
<td align="center"><input type="image" src="../icone/update.png" onclick="window.location='updateTopic.php?topic=<?=$row["id"]?>';"/></td>
<td align="center"><input type="image" src="../icone/delete.png" onclick="if(confirm('Delete topic <?=addslashes(str_replace("\"", "&quot;", $row["name"]))?>?')) window.location='delTopic.php?topic=<?=$row["id"]?>';"/></td>
<td align="center"><a href="downTopic.php?topic=<?=$row["id"]?>"><img src="../icone/up.png" /></a></td>
<td align="center"><a href="upTopic.php?topic=<?=$row["id"]?>"><img src="../icone/down.png" /></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<h2>New topic</h2>
<form action="addTopic.php" method="post">
<input id="textbox" type="text" name="name" len="100" value="New topic" />
<br/>
<textarea name="description">Description</textarea>
<br/>
<input type="image" onclick="submit();" src="../icone/add.png" />
</form>
</div>

<?php

if (isset($_GET["topic"])){
	$sql = "select name from topic where id = \"".$_GET["topic"]."\";";
	$result = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($result);
	$topic_id = $_GET["topic"];
	$topic_name = $row["name"];
}
else{
	$topic_id = -1;
	$topic_name = "";
}

if ($topic_name != ""){
$sql = "select id, title, description, vimeo_url from work where topic = ".$topic_id." order by id;";
$result = mysql_query($sql) or die (mysql_error());
?>
<div class="box">
<h1>Works</h1>
<h2>(Topic: <?=$topic_name?>)</h2>
<table>
<thead>
<tr>
<th>Title</th>
<th>Description</th>
<th colspan="2">Picture / video</th>
<th>Update</th>
<th>Delete</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
while ($row = mysql_fetch_assoc($result)){
?>
<tr>
<td><?=$row["title"]?></td>
<td><?=$row["description"]?></td>
<?
// if there is a Vimeo URL the work is a video, thus do not show pictures
if ($row["vimeo_url"] == ""){
?>
<td>
<!--<img width="100px" src="../works/<?echo($topic_id);?>-<?echo($row["id"]);?>.jpg?<? time(); ?>" />-->
<?
echo '<a href="../works/'.$topic_id.'-'.$row["id"].'.jpg" target="_blank" />';
echo '<img width="100px" src="../works/'.$topic_id.'-'.$row["id"].'.jpg?' , time() , '" />';
?>
</td>
<td>
<form method="post" action="uploadPicture.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="upload" />
<input type="hidden" name="topic" value="<?=$topic_id?>" />
<input type="hidden" name="work" value="<?=$row["id"]?>" />
<input type="file" name="user_file" />
<input type="image" src="../icone/upload.png" onclick="submit();" />
</form>
</td>
<?
}
// if there is a Vimeo URL the work is a video
else {
?>
<td colspan="2"><?=$row["vimeo_url"]?></td>
<?
}
?>
<td align="center">
<input type="image" src="../icone/update.png" onclick="window.location='updateWork.php?topic=<?=$topic_id?>&work=<?=$row["id"]?>';" />
</td>
<td align="center"><input type="image" src="../icone/delete.png" onclick="if(confirm('Delete work <?=addslashes(str_replace("\"", "&quot;", $row["title"]))?>?')) window.location='delWork.php?topic=<?=$topic_id?>&work=<?=$row["id"]?>';"/></td>
<td align="center"><a href="downWork.php?topic=<?=$topic_id?>&work=<?=$row["id"]?>"><img src="../icone/up.png" /></a></td>
<td align="center"><a href="upWork.php?topic=<?=$topic_id?>&work=<?=$row["id"]?>"><img src="../icone/down.png" /></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<h2>New work</h2>
<form action="addWork.php" method="post">
<input  id="textbox" type="text" name="title" len="100" value="New work" />
<input type="hidden" name="topic" value="<?=$topic_id?>" />
<br/>
<textarea name="description">Description</textarea>
<br/>
(video) Vimeo URL:<br/>
<input  id="textbox" type="text" name="vimeo_url" len="100" value="http://vimeo.com/" />
<br/>
<input type="image" onclick="submit();" src="../icone/add.png" />
</form>
</div>
<?
}
?>
<?php include("footer.php");?>

