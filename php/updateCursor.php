<?php
require_once("config.php");

if (isset($_POST["x"]) and isset($_POST["y"]) and is_numeric($_POST["x"]) and is_numeric($_POST["y"])) {
	$x = intval($_POST["x"]);
	$y = intval($_POST["y"]);
	sql("UPDATE curseurs set x = ?, y = ? where userId = ?", array($x, $y, $_SESSION["id"]));
}

?>
