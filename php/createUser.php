<?php
require_once("config.php");

if (isset($_POST["name"]) and trim($_POST["name"])) {
	$name = trim($_POST["name"]);
	sql("INSERT into users (name, color) values (?, ?) limit 1", array($name, randRgb()));
	$id = sql("SELECT id from users where name = ? order by id desc limit 1", array($name), false)[0];
	sql("INSERT into curseurs (userId, x, y) values (?, ?, ?)", array($id, random_int(0, 1920), random_int(0, 1080)));

	$_SESSION["name"] = $name;
	$_SESSION["id"] = $id;
}

?>
