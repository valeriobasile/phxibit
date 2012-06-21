<?php include("header.php");?>
<script type="text/javascript" src="jscolor/jscolor.js"></script>

<form action="confirmUpdateStyle.php" method="post" enctype="multipart/form-data">

<div class="box">
<h1>Static images</h1>

<h2>Logo</h2>
<img src="<?='../'.$config['img_dir'].'/'.$config['logo_file']?>" /><br/>
<input type="file" name="logo" />
<input type="image" src="<?=$config['admin_icons_dir']?>/upload.png" onclick="submit();" />

<input type="submit" value="save" />

<h2>Portrait</h2>
<img src="<?='../'.$config['img_dir'].'/'.$config['portrait_file']?>" /><br/>
<input type="file" name="portrait" />
<input type="image" src="<?=$config['admin_icons_dir']?>/upload.png" onclick="submit();" />

<input type="submit" value="save" />

<h2>"Previous" arrow</h2>
<img src="<?='../'.$config['img_dir'].'/'.$config['icon_prev']?>" /><br/>
<input type="file" name="icon_prev" />
<input type="image" src="<?=$config['admin_icons_dir']?>/upload.png" onclick="submit();" />

<input type="submit" value="save" />

<h2>"Next" arrow</h2>
<img src="<?='../'.$config['img_dir'].'/'.$config['icon_next']?>" /><br/>
<input type="file" name="icon_next" />
<input type="image" src="<?=$config['admin_icons_dir']?>/upload.png" onclick="submit();" />

<input type="submit" value="save" />
</div>

<?
$sql = "select background_color, text_color, link_color, font from style;";
$result = $dbh->query($sql);
$row = $result->fetch();

$background_color = $row["background_color"];
$text_color = $row["text_color"];
$link_color = $row["link_color"];
$font = $row["font"];

?>

<div class="box">
<h1>Colors &amp; font</h1>
Background           <input name="background_color" class="color" value="<?=$background_color?>" /><br/>
Text                 <input name="text_color"       class="color" value="<?=$text_color?>" /><br/>
Link/secondary color <input name="link_color"       class="color" value="<?=$link_color?>" /><br/>

<br/>
<h2>Font</h2>
<?
$fonts = array("Lusitana", "Overlock", "Gentium Basic", "Seaweed Script", "Advent Pro");
?>
<?foreach ($fonts as $font_item){?>
<?if ($font_item == $font) {?>
<input name="font" type="radio" value="<?=$font_item?>" checked="checked" />
<?
} 
else {
?>
<input name="font" type="radio" value="<?=$font_item?>" />
<?}?>
<span style="font-family: '<?=$font_item?>';"><?=$font_item?></span>
</input>
<?}?>

<br/>
<input type="submit" value="save" />
</div>

<div class="box">
<h1>Layout</h1>

</div>

</form>
<?php include("footer.php");?>

