<?php include("header.php");?>

<div class="box">
<h1>Pages</h1>
<form action="confirmUpdatePages.php" method="post" >
<?php
$sql = "select id, active from page;";
$result = mysql_query($sql) or die (mysql_error());
while ($row = mysql_fetch_assoc($result)){
    
    if ($row["active"]==1) {
?>
<input type="checkbox" name="<?=$row['id']?>" checked="checked"><?=$row['id']?></input><br/>
<?
    }
    else {
?>
<input type="checkbox" name="<?=$row['id']?>"><?=$row['id']?></input><br/>
<?    
    }
}
?>
<input type="submit" value="save" />
</form>
</div>

<?php include("footer.php");?>

