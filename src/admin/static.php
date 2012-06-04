<?php include("header.php");?>
<form action="confirmUpdateStatic.php" method="post" >

<div class="box">
<h1>Biography</h1>
<?php
$biography = file_get_contents("../".$config["static_dir"]."/".$config["biography_file"]);
?>
<textarea name="biography"><?=$biography?></textarea>
<br/>
<input type="submit" value="save" />
</div>

<div class="box">
<h1>Contact</h1>
<?php
$contact = file_get_contents("../".$config["static_dir"]."/".$config["contact_file"]);
?>
<textarea name="contact"><?=$contact?></textarea>
<br/>
<input type="submit" value="save" />
</div>

<div class="box">
<h1>Footer</h1>
<?php
$footer = file_get_contents("../".$config["static_dir"]."/".$config["footer_file"]);
?>
<textarea name="footer"><?=$footer?></textarea>
<br/>
<input type="submit" value="save" />
</div>

</form>
<?php include("footer.php");?>

