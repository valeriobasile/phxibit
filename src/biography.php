<?php
include("header.php");
include("mysql.php");
?>


<?php

if (isset($_GET["exhibition"]))
	$id_exhibition = $_GET["exhibition"];
else
	$id_exhibition = 1;



# static description
?>
		<div id="contentMenu">
			
		</div>
<div id="contentBoxL">
			<div id="portrait"><img src="img/portrait-2.jpg" alt="Katharina Dieckhoff" width="155" height="197">
			</div>
			<h1>Katharina Dieckhoff</h1>
			<br />
			March,8th 1976 / Maastricht (NL).<br /> German nationality, in Italy (Bologna) since 1995.<br /><br />
2005 Master in History of Arts at the University of Bologna.<br />2003 Master in Painting at the Academy of Fine Arts of Bologna.<br />Artistic stays at New York and Berlin. <br />
</div>


		<div id="contentBoxR">
		
		</div>


<?php
include("footer.php");
?>
