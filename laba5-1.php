<html>
<head>	
		<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <h2>Редактирование информации о магазине</h2>
<?php

$db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

$rows = mysqli_query($db, "SELECT s_name, s_url FROM shop WHERE id = ".$_GET['id_shop']);

while ($st = mysqli_fetch_array($rows)) {
    $id = $_GET['id_shop'];
    $name = $st['s_name'];
    $url = $st['s_url'];
}

print "<form action='laba5-4.php' metod='get'>";
print "Название <br><input name='inp_name' size='50' type='text' value='" .$name . "'>";
print "<br><br>URL <br><input name='inp_url' size='20' type='text' value='" . $url . "'>";
print "<br><input type='hidden' name='id_shop' value='".$id."'>";
print "<br><input type='submit' name='save' value='Сохранить'>";
print "</form>";
print "<p><a href=\"laba5.php\"> назад </a>";

?>

</body>
</html>