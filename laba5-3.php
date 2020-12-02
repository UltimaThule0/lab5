<?php
$db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

if ($_GET['id_game'] != null) {
	$zapros = "DELETE FROM games WHERE id =" . $_GET['id_game'];
}
if ($_GET['id_shop'] != null) {
	$zapros = "DELETE FROM shop WHERE id =" . $_GET['id_shop'];
}
if ($_GET['id_key'] != null) {
	$zapros = "DELETE FROM k_ey WHERE id =" . $_GET['id_key'];
}

mysqli_query($db, $zapros);
header("Location: laba5.php");
exit;
?>