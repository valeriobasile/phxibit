<?php
include("header.php");
?>
<div id="portrait">
<img src="<?=$config['img_dir']?>/<?=$config['portrait_file']?>" alt="<?=$config['artist']?>">
</div>
<div id="biography">
<h1><?=$config['artist']?></h1>
<?php
include($config['static_dir']."/".$config['biography_file']);
?>
</div>
<?php
include("footer.php");
?>
