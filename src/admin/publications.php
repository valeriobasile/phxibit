<?php include("header.php");?>
<?php
$sql = "select * from category order by id;";
$result = $dbh->query($sql);
?>
<div class="box">
<h1>Category</h1>
<table>
<thead>
<tr>
<th>Category</th>
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
<td><a href="publications.php?category=<?=$row["id"]?>"><?=$row["name"]?></a></td>
<td align="center"><input type="image" src="<?=$config['admin_icons_dir']?>/update.png" onclick="window.location='updateCategory.php?category=<?=$row["id"]?>';"/></td>
<td align="center"><input type="image" src="<?=$config['admin_icons_dir']?>/delete.png" onclick="if(confirm('Delete category <?=addslashes(str_replace("\"", "&quot;", $row["name"]))?>?')) window.location='delCategory.php?category=<?=$row["id"]?>';"/></td>
<td align="center"><a href="downCategory.php?category=<?=$row["id"]?>"><img src="<?=$config['admin_icons_dir']?>/up.png" /></a></td>
<td align="center"><a href="upCategory.php?category=<?=$row["id"]?>"><img src="<?=$config['admin_icons_dir']?>/down.png" /></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<h2>New category</h2>
<form action="addCategory.php" method="post">
<input id="textbox" type="text" name="name" len="100" value="New category" />
<br/>
<input type="image" onclick="submit();" src="<?=$config['admin_icons_dir']?>/add.png" />
</form>
</div>

<?php

if (isset($_GET["category"])){
	$sql = "select name from category where id = \"".$_GET["category"]."\";";
	$result = $dbh->query($sql);
	$row = $result->fetch();
	$category_id = $_GET["category"];
	$category_name = $row["name"];
}
else{
	$category_id = -1;
	$category_name = "";
}

if ($category_name != ""){
$sql = "select id, title, description, text from publication where category = ".$category_id." order by id;";
$result = $dbh->query($sql);
?>
<div class="box">
<h1>publications</h1>
<h2>(Category: <?=$category_name?>)</h2>
<table>
<thead>
<tr>
<th>Title</th>
<th>Description</th>
<th>Picture</th>
<th>Upload picture</th>
<th>Text</th>
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
<!--<img width="100px" src="../publications/<?echo($category_id);?>-<?echo($row["id"]);?>.jpg?<? time(); ?>" />-->
<?
echo '<a href="../publications/'.$category_id.'-'.$row["id"].'.jpg" target="_blank" />';
echo '<img width="100px" src="../publications/'.$category_id.'-'.$row["id"].'.jpg?' , time() , '" />';
?>
</td>
<td>
<form method="post" action="uploadPublication.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="upload" />
<input type="hidden" name="category" value="<?=$category_id?>" />
<input type="hidden" name="publication" value="<?=$row["id"]?>" />
<input type="file" name="user_file" />
<input type="image" src="<?=$config['admin_icons_dir']?>/upload.png" onclick="submit();" />
</form>
</td>
<td><?=$row["text"]?></td>
<td align="center">
<input type="image" src="<?=$config['admin_icons_dir']?>/update.png" onclick="window.location='updatePublication.php?category=<?=$category_id?>&publication=<?=$row["id"]?>';" />
</td>
<td align="center"><input type="image" src="<?=$config['admin_icons_dir']?>/delete.png" onclick="if(confirm('Delete publication <?=addslashes(str_replace("\"", "&quot;", $row["title"]))?>?')) window.location='delPublication.php?category=<?=$category_id?>&publication=<?=$row["id"]?>';"/></td>
<td align="center"><a href="downPublication.php?category=<?=$category_id?>&publication=<?=$row["id"]?>"><img src="<?=$config['admin_icons_dir']?>/up.png" /></a></td>
<td align="center"><a href="upPublication.php?category=<?=$category_id?>&publication=<?=$row["id"]?>"><img src="<?=$config['admin_icons_dir']?>/down.png" /></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
<h2>New publication</h2>
<form action="addPublication.php" method="post">
<input  id="textbox" type="text" name="title" len="100" value="New publication" />
<input type="hidden" name="category" value="<?=$category_id?>" />
<br/>
<textarea name="description">Description</textarea>
<br/>
<textarea name="text">Text</textarea>
<br/>
<input type="image" onclick="submit();" src="<?=$config['admin_icons_dir']?>/add.png" />
</form>
</div>
<?
}
?>
<?php include("footer.php");?>

