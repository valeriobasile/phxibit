<?php
// index.php

# if there is no config file, this is a fresh install
if (file_exists("install") && !file_exists("config/config.ini")) {
    header("location: install/install.php");
}
# if the install directory is still there, redirect to the installation script
elseif (file_exists("install") && file_exists("config/config.ini")) {
    header("location: install/warning.php");
}
# if the install directory is NOT there, go to the home page
else {
    header("location: home.php");
}

?>
