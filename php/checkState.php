<?php
require_once("config.php");
$x = sql("SELECT count(*) from curseurs", null, false)[0];
if ($x) echo "true";
else echo "false";
?>
