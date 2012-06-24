<?php include("header.php");?>
<?
if (isset($_GET["confirm"])){
?>
The administration password has been updated.
<?}?>
<div class="box">
<h1>Admin password</h1>
<form action="confirmUpdateAdministration.php" method="post">
<input id="admin_password" type="password" name="admin_password" value="" />
<br/>
<input type="submit" value="save"/>
</form>
</div>
<?php include("footer.php");?>

