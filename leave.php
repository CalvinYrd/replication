<?php
require_once("php/config.php");

if (isset($_SESSION["id"]) and isset($_SESSION["name"])) {
	$id = intval($_SESSION["id"]);
	sql("DELETE from users where id = ? limit 1", array($id));
	sql("DELETE from curseurs where userId = ?", array($id));
	session_destroy();
}
header("Location: index.php");

?>
