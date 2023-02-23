<?php

function debug($dat) {
	echo "<pre>";
	var_dump($dat);
	echo "</pre>";
}
function html($tag, $fields = null, $inner = null) {
	$str = "<".$tag;
	if ($fields) {
		foreach ($fields as $key => $val) {
			$val = str_replace("'", "&#39;", $val);
			$str .= " ".$key."='".$val."'";
		}
	}
	$str .= ">".$inner."</".$tag.">";
	return $str;
}
function sql($query, $parameters = null, $fetchAll = True) {
	global $pdo;
	$stmt = $pdo->prepare($query);
	$stmt->execute($parameters);
	$results = ($fetchAll ? $stmt->fetchAll() : $stmt->fetch());
	$stmt->closeCursor();
	return $results;
}
function connect() {
	session_start();

	if (isset($_SESSION["id"]) and isset($_SESSION["name"])) {
		$userExists = sql("SELECT count(*) from users where id = ? and name = ?", array($_SESSION["id"], $_SESSION["name"]), false)[0];
		$userExists = boolval($userExists);
	}
	else $userExists = false;
	return $userExists;
}
function randRgb() {
	foreach (explode(" ", "r b g") as $var) $$var = random_int(0, 255);
	$col = "rgb($r, $g, $b)";
	return $col;
}

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
session_start();

try {
	$pdo = new PDO("mysql:host=localhost;dbname=replication", "root", "");
}
catch (Exception $e) {
	echo "ERREUR DE CONNEXION A LA BASE DE DONNEES";
}

?>
