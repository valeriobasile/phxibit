<?php include("header.php");?>

<?php


$sql = "select id, description, url from link order by id;";
$result = mysql_query($sql) or die (mysql_error());
?>
<div class="box">
<h1>Links</h1>
<table>
<thead>
<tr>
<th>Description</th>
<th>Url</th>
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
<td><?=$row["description"]?></td>
<td><a href="<?=$row["url"]?>" target="_blank"><?=$row["url"]?></a></td>
<td align="center">
<input type="image" src="../icone/update.png" onclick="window.location='updateLink.php?topic=<?=$topic_id?>&link=<?=$row["id"]?>';" />
</td>
<td align="center"><input type="image" src="../icone/delete.png" onclick="if(confirm('Delete link <?=addslashes(str_replace("\"", "&quot;", $row["url"]))?>?')) window.location='delLink.php?link=<?=$row["id"]?>';"/></td>
<td align="center"><a href="downLink.php?link=<?=$row["id"]?>"><img src="../icone/up.png" /></a></td>
<td align="center"><a href="upLink.php?link=<?=$row["id"]?>"><img src="../icone/down.png" /></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<h2>New link</h2>
<form action="addLink.php" method="post">
<input  id="textbox" type="text" name="url" len="100" value="http://" />
<br/>
<textarea name="description">Description</textarea>
<br/>
<input type="image" onclick="submit();" src="../icone/add.png" />
</form>
</div>

<?php include("footer.php");?>

