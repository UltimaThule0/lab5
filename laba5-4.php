<?php
$db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

if ($_GET['id_game'] != null) {
	
	$zapros = "UPDATE `games` SET `games`.`g_name` = '{$_GET['name']}', `games`.`g_janr` = '{$_GET['janr']}', `games`.`g_razrab` = '{$_GET['razrab']}', `games`.`g_izdat` = '{$_GET['izdat']}', `games`.`g_prodazh` = '{$_GET['prodazh']}' 
	WHERE `games`.`id` = '{$_GET['id_game']}'";

}elseif ($_GET['id_shop'] != null) {
	
	$zapros = "UPDATE `shop` SET `shop`.`s_name` = '{$_GET['inp_name']}', `shop`.`s_url` = '{$_GET['inp_url']}'	WHERE `shop`.`id` = '{$_GET['id_shop']}'";

}elseif ($_GET['id_key'] != null) {
	
	$zapros = "UPDATE `k_ey` SET `k_ey`.`date_start` = '{$_GET['inp_start']}', `k_ey`.`date_end` = '{$_GET['inp_end']}', 
	`k_ey`.`s_id` = '{$_GET['shop_id']}', `k_ey`.`cost` = '{$_GET['inp_cost']}', `k_ey`.`kluch` = '{$_GET['inp_key']}'
	WHERE `k_ey`.`id` = '{$_GET['id_key']}'";
}

mysqli_query($db, $zapros);
header("Location: laba5.php");
?>