<?php include("header.php");?>

<?php


$sql = "select id, title, description from exhibition order by id;";
$result = $dbh->query($sql);
?>
<div class="box">
<h1>Exhibitions</h1>
<table>
<thead>
<tr>
<th>Title</th>
<th>Description</th>
<th>Picture</th>
<th>Upload picture</th>
<th>Update</th>
<th>Delete</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
while ($row = $result->fetch()){
?>
<tr>
<td><?=$row["title"]?></td>
<td><?=$row["description"]?></td>
<td>
<?
echo '<a href="../exhibitions/'.$row["id"].'.jpg" target="_blank" />';
echo '<img width="100px" src="../exhibitions/'.$row["id"].'.jpg?' , time() , '" />';
?>
</td>
<td>
<form method="post" action="uploadExhibition.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="upload" />
<input type="hidden" name="exhibition" value="<?=$row["id"]?>" />
<input type="file" name="user_file" />
<input type="image" src="<?=$config['admin_icons_dir']?>/upload.png" onclick="submit();" />
</form>
</td>
<td align="center">
<input type="image" src="<?=$config['admin_icons_dir']?>/update.png" onclick="window.location='updateExhibition.php?topic=<?=$topic_id?>&exhibition=<?=$row["id"]?>';" />
</td>
<td align="center"><input type="image" src="<?=$config['admin_icons_dir']?>/delete.png" onclick="if(confirm('Delete exhibition <?=addslashes(str_replace("\"", "&quot;", $row["title"]))?>?')) window.location='delExhibition.php?exhibition=<?=$row["id"]?>';"/></td>
<td align="center"><a href="downExhibition.php?exhibition=<?=$row["id"]?>"><img src="<?=$config['admin_icons_dir']?>/up.png" /></a></td>
<td align="center"><a href="upExhibition.php?exhibition=<?=$row["id"]?>"><img src="<?=$config['admin_icons_dir']?>/down.png" /></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<h2>New exhibition</h2>
<form action="addExhibition.php" method="post">
<input  id="textbox" type="text" name="title" len="100" value="New exhibition" />
<br/>
<textarea name="description">Description</textarea>
<br/>
<input type="image" onclick="submit();" src="<?=$config['admin_icons_dir']?>/add.png" />
</form>
</div>
<?php include("footer.php");?>

