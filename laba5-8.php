<!DOCTYPE html>
<html>
<head>	
		<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Редактирование информации об игре</h2>
<?php

$db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

$rows = mysqli_query($db, "SELECT g_name, g_janr, g_razrab, g_izdat, g_prodazh FROM games WHERE id=".$_GET['id']);

while ($st = mysqli_fetch_array($rows)) {
    $id = $_GET['id'];
    $name = $st['g_name'];
    $janr = $st['g_janr'];
    $razrab = $st['g_razrab'];
    $izdat = $st['g_izdat'];
    $prodazh = $st['g_prodazh'];
}

print "<form action='laba5-4.php' metod='get'>";
print "Название <br><input name='name' size='50' type='text' value='" . $name . "'>";
print "<br>Жанр <br><input name='janr' size='20' type='text' value='" . $janr . "'>";
print "<br>Разработчик <br><input name='razrab' size='20' type='text' value='" . $razrab . "'>";
print "<br>Издательство <br><input name='izdat' size='30' type='text' value='".$izdat."'>";
print "<br>Объем продаж <br><input name='prodazh' size='10' type='text' value='".$prodazh."'>";
print "<br><input type='hidden' name='id_game' value='".$id."'> <br>";
print "<br><input type='submit' name='save' value='Изменить'>";
print "</form>";
print "<p><a href=\"laba5.php\"> назад </a>";

?>

</body>
</html>