<html>
<head>  
        <meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<H2>Новый цифровой магазин</H2>
    
    <?php
        $db = mysqli_connect("localhost", "f0491495_games", "12345", "f0491495_games")or die("Невозможно подключиться к серверу");
mysqli_query($db, "SET NAMES utf8");
    ?>

<form action='laba5-5.php' metod='get'>
Название магазина <br><input name='name' size='40' type='text'>
<br><br>
URL <br><input name='url' size='40' type='text'>
<br><br><input name='add_shop' type='submit' value='Добавить'>
<br><br><input name='b2' type='reset' value='Очистить'>
</form>
<br><a href="laba5.php"> назад </a>
        
    </body>
</html>