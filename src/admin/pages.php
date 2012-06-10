<?php include("header.php");?>

<div class="box">
<h1>Pages</h1>
<form action="confirmUpdatePages.php" method="post" >
<?php
$sql = "select id, active from page;";
$result = $dbh->query($sql);
while ($row = $result->fetch()){
    
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

