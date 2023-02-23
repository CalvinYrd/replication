<?php
require_once("config.php");

$res = sql(
	"SELECT c.x, c.y, u.id, u.name, u.color from curseurs c
	inner join users u
	on u.id = c.userId"
);
echo json_encode($res);
?>
