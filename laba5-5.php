<?php
$db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

if ($_GET['add_game'] != null) {
	$sql_add = "INSERT INTO games SET g_name='" . $_GET['name'] ."', g_janr='".$_GET['janr']."', g_razrab='" .$_GET['razrab']."', g_izdat='".$_GET['izdat']. "', g_prodazh='".$_GET['prodazh']. "'";

}elseif ($_GET['add_shop'] != null) {
	
	$sql_add = "INSERT INTO shop SET s_name='" . $_GET['name'] ."', s_url='".$_GET['url']."'";

}elseif ($_GET['add_kluch'] != null) {

	$n = substr($_GET['game'], -1, 1);
	$g = "g_id". $n;
	$gid = "" . $_GET[$g];

	$n = substr($_GET['shop'], -1, 1);
	$s = "s_id". $n;
	$sid = "" . $_GET[$s];

	$sql_add = "INSERT INTO k_ey SET date_start='" . $_GET['start'] ."', date_end='" . $_GET['end'] ."', g_id='" . $gid ."', s_id='" . $sid ."', cost='" . $_GET['cost'] ."', kluch='" . $_GET['kluch'] ."'";
}

	mysqli_query($db, $sql_add);
	header("Location: laba5.php");
?>