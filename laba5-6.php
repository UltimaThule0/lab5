<html>
<head>  
        <meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Редактирование информации о ключе</h2>
<?php
$db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");

$rows = mysqli_query($db,
    "SELECT k.date_start, k.date_end, k.cost, k.kluch, g.g_name, s.s_name, s.id
    FROM k_ey k
    INNER JOIN games g ON g.id = k.g_id
    INNER JOIN shop s ON s.id = k.s_id
    WHERE k.id = ".$_GET['id_key']);

$row = mysqli_query($db, "SELECT s_name FROM shop");
$i = 0;
while ($col = mysqli_fetch_array($row)) {
    $shop_names[$i] = $col['s_name'];
    $i++;
}

while ($st = mysqli_fetch_array($rows)) {
    $start = $st['date_start'];
    $end = $st['date_end'];
    $cost = $st['cost'];
    $kluch = $st['kluch'];
    $g_name = $st['g_name'];
    $s_name = $st['s_name'];
    $shop_id = $st['id'];
}

$startDate = $start;
$startDate = date("Y-m-d", strtotime($startDate));

$endDate = $end;
$endDate = date("Y-m-d", strtotime($endDate));

$id = $_GET['id_key'];

print "<form action='laba5-4.php' metod='get'>";
print "Дата приобретения<br><input type='date' name='inp_start' value='" .$startDate . "'>";
print "<br><br>Дата окончания<br><input type='date' name='inp_end' value='" . $endDate . "'>";
print "<br><br>Игра<br><input name='inp_game' size='30' type='text' value='" .$g_name . "'readonly>";
?>
<br><br>Магазин<br>
<select class='form-control' name='inp_shop'>
    <?php
        for($i = 0; $shop_names[$i] != null; $i++): 
            if ($shop_names[$i] == $s_name) {?>
            <option selected value="<?=$shop_names[$i]?>"><?=$shop_names[$i]?></option>
        <?php } else{?>
            <option value="<?=$shop_names[$i]?>"><?=$shop_names[$i]?></option>
    <?php } endfor;?>
</select>
<?php
print "<br><br>Стоимость<br><input name='inp_cost' size='10' type='text' value='" .$cost . "'>";
print "<br><br>Ключ<br><input name='inp_key' size='10' type='text' value='" . $kluch . "'>";
print "<br><input type='hidden' name='id_key' value='".$id."'>";
print "<input type='hidden' name='shop_id' value='".$shop_id."'>";
print "<br><input type='submit' name='save' value='Сохранить'>";
print "</form>";
print "<p><a href=\"laba5.php\"> назад </a>";


?>

</body>
</html>