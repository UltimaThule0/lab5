<html>
<head>  
        <meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
        <H2>Новый ключ</H2>
<?php
$db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

$rowshop = mysqli_query($db, "SELECT  id as s_id, s_name FROM shop");
$rowgame = mysqli_query($db, "SELECT id as g_id, g_name FROM games");

$i=0;
while ($st = mysqli_fetch_array($rowshop)) {
    $s_id[$i] = $st['s_id'];
    $s_name[$i] = $st['s_name'];
    $i++;
}

$j=0;
while ($col = mysqli_fetch_array($rowgame)) {
    $g_id[$j] = $col['g_id'];
    $g_name[$j] = $col['g_name'];
$j++;
}
?>

<form action='laba5-5.php' metod='get'>
Дата приобретения
<br><input type='date' name='start'>
<br><br>Дата окончания
<br><input type='date' name='end'>
<br><br>Название игры
<br><select class='form-control' name='game'>
<?php
for($i = 0; $g_name[$i] != null; $i++): ?>
     <option value="<?=$g_name[$i].$i?>"><?=$g_name[$i]?></option>
<?php endfor;
for($i = 0; $g_id[$i] != null; $i++){
    $name = "g_id". $i;
    $value = "" . $g_id[$i];
    print "<input type='hidden' name='".$name."' value='".$value."'>";
}
?>
</select>
<br><br>Магазин
<br><select class='form-control' name='shop'>
<?php
for($i = 0; $s_name[$i] != null; $i++): ?>
     <option value="<?=$s_name[$i].$i?>"><?=$s_name[$i]?></option>
<?php endfor;
for($i = 0; $s_id[$i] != null; $i++){
    $name = "s_id". $i;
    $value = "" . $s_id[$i];
    print "<input type='hidden' name='".$name."' value='".$value."'>";
}
?>
</select>
<br><br>Стоимость
<br><input name='cost' size='10' maxlength="10" type='text'>
<br><br>Ключ
<br><input name='kluch' size='10' maxlength="10" type='text'>
       
<br><p><input name='add_kluch' type='submit' value='Добавить'>
<br><br><input name='b2' type='reset' value='Очистить'></p>
</form>
<p><a href="laba5.php"> назад </a>

    </body>
</html>