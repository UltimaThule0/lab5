<html>
<head>	
		<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$db = mysqli_connect("localhost", "root", "root1", "maks")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");
?>

<h2>ИГРЫ:</h2>
<table border="1">
    <tr>
    <th> Название </th> <th> Жанр </th> <th> Разработчик </th>
    <th> Издатель </th> <th> Объем продаж </th>
    <th> </th> <th> </th> </tr>
    <?php
    $sql = mysqli_query($db, "SELECT id, g_name, g_janr, g_razrab, g_izdat, g_prodazh FROM games");
    while ($row = mysqli_fetch_array($sql)){
        echo "<tr>";
        echo "<td>" . $row['g_name'] . "</td>";
        echo "<td>" . $row['g_janr'] . "</td>";
        echo "<td>" . $row['g_razrab'] . "</td>";
        echo "<td>" . $row['g_izdat'] . "</td>";
        echo "<td>" . $row['g_prodazh'] . "</td>";
        echo "<td><a href='laba5-8.php?id_game=" . $row['id'] . "'>Редактировать</a></td>";
        echo "<td><a href='laba5-3.php?id_game=" . $row['id'] . "'>Удалить</a></td>";
        echo "</tr>";
    }
    print "</table>";
    $num_rows = mysqli_num_rows($sql);
    print("<P>Количество игр: $num_rows </p>");
   ?>
    <p> <a href = "laba5-9.php"> Новая игра </a>
    </br></br>

    <h2>Цифровые магазины</h2>
<table border="1">
    <tr>
    <th> Название </th> <th> URL </th>
    <th> </th> <th> </th> </tr>
    <?php
    $sql = mysqli_query($db, "SELECT id, s_name, s_url FROM shop");

    while ($row = mysqli_fetch_array($sql)){
        echo "<tr>";
        echo "<td>" . $row['s_name'] . "</td>";
        echo "<td>" . $row['s_url'] . "</td>";
        echo "<td><a href='laba5-1.php?id_shop=" . $row['id'] . "'>Редактировать</a></td>";
        echo "<td><a href='laba5-3.php?id_shop=" . $row['id'] . "'>Удалить</a></td>";
        echo "</tr>";
    }
    print "</table>";
    $num_rows = mysqli_num_rows($sql); 
    print("<P>Цифровых магазинов - $num_rows </p>");
    echo "<a href = 'laba5-2.php'> Добавить магазин </a>";
    ?>
    </br></br>

    <h2>Цифровые ключи</h2>
<table border="1">
    <tr>
    <th> Дата приобретения </th> <th> Дата окончания </th>
    <th> Игра </th> <th> Магазин </th>
    <th> Стоимость </th> <th> Ключ </th>
    <th> </th> <th> </th> </tr>
    <?php

    $sql = mysqli_query($db, 
        "SELECT k.id, k.date_start, k.date_end, k.cost, k.kluch, g.g_name, s.s_name
        FROM k_ey k
        INNER JOIN games g ON g.id = k.g_id
        INNER JOIN shop s ON s.id = k.s_id");

    while ($row = mysqli_fetch_array($sql)){
        echo "<tr>";
        echo "<td>" . date_format(date_create_from_format('Y-m-d', $row['date_start']),'d.m.Y') . "</td>";
        echo "<td>" . date_format(date_create_from_format('Y-m-d', $row['date_end']),'d.m.Y') . "</td>";
        echo "<td>" . $row['g_name'] . "</td>";
        echo "<td>" . $row['s_name'] . "</td>";
        echo "<td>" . $row['cost'] . "</td>";
        echo "<td>" . $row['kluch'] . "</td>";
        echo "<td><a href='laba5-6.php?id_key=" . $row['id']. "'>Редактировать</a></td>";
        echo "<td><a href='laba5-3.php?id_key=" . $row['id'] . "'>Удалить</a></td>";
        echo "</tr>";
    }
    print "</table>";
    $num_rows = mysqli_num_rows($sql);
    print("<P>Количество ключей $num_rows </p>");
    echo "<a href = 'laba5-7.php'>Новый ключ</a>";
    ?>
    </br></br>
    <p> <a href = "laba5pdf.php"> Таблица PDF </a>
        </br></br>
    <p> <a href = "laba5xls.php"> Таблица Excel </a>
</body> 
</html>