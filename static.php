<?php
session_start();
        if($_SESSION['admin'] != "admin"){
                header("Location: login.php");
                exit;
        }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
</head>
<body>
<title>Страница cтатистики</title>
<center>
<h1 class="logo2">Статистика</h1>
</center>
<div class="inf">
<p>Количество пользователей: 4</p>
<p>Количество пользователей онлайн: 3</p>
<p>Количество пользователей оффлайн: 1</p>
</div>

<?php
$servername = "localhost"; // Адрес сервера
$username = "ce82742_web"; // Имя пользователя
$password = "12345678Web"; // Пароль
$BDname = "ce82742_web"; // Название БД

// Подключение к БД
$mysqli = new mysqli($servername, $username, $password, $BDname);

// Проверка на ошибку
if ($mysqli->connect_error) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
}
// Получаем запрос
$inputSearch = $_REQUEST['search']; 

// Создаём SQL запрос
$sql = "SELECT * FROM `users` WHERE `cabinet` = '$inputSearch' || `set_rosette` = '$inputSearch' || `switch_port` = '$inputSearch' || `MAC_address` = '$inputSearch' || `binding` = '$inputSearch' || `IP_address` = '$inputSearch' || `dns` = '$inputSearch' || `ntp` = '$inputSearch' || `list_number` = '$inputSearch' || `email` = '$inputSearch' || `login` = '$inputSearch' || `PC_name` = '$inputSearch' || `OS` = '$inputSearch' || `FIO` = '$inputSearch' || `squad` = '$inputSearch' || `logs` = '$inputSearch' || `antivirus` = '$inputSearch' || `SSH` = '$inputSearch' || `Webmin` = '$inputSearch' || `RDP` = '$inputSearch' || `PC_maker` = '$inputSearch' || `PC_model` = '$inputSearch' || `series_number` = '$inputSearch' || `others` = '$inputSearch'";

// Отправляем SQL запрос
$result = $mysqli -> query($sql);

function doesItExist(array $arr) {
    // Создаём новый массив
    $data = array(
        'cabinet' => $arr['cabinet'] != false ? $arr['cabinet'] : 'Нет данных',
        'set_rosette' => $arr['set_rosette'] != false ? $arr['set_rosette'] : 'Нет данных',
        'switch_port' => $arr['switch_port'] != false ? $arr['switch_port'] : 'Нет данных'
    );
    return $data; // Возвращаем этот массив
}

function countPeople($result) {
    // Проверка на то, что строк больше нуля
    if ($result -> num_rows > 0) {
        // Цикл для вывода данных
        while ($row = $result -> fetch_assoc()) {
            // Получаем массив с строками которые нужно выводить
            $arr = doesItExist($row);
            // Вывод данных
            echo  " Номер кабинета: ". $arr['cabinet'] ."<br>
                  Номер сетевой розетки: ". $arr['set_rosette'] ."<br>
                  Номер порта коммутатора: ". $arr['switch_port'] ."<br>
                  MAC-адрес: ". $row['MAC_address'] ."<br>
                  Привязка: ". $row['binding'] ."<br>
                  IP-адрес: ". $row['IP_address'] ."<br>
                  IP-адрес используемого DNS: ". $row['dns'] ."<br>
                  IP-адрес исипользуемого NTP: ". $row['ntp'] ."<br>
                  Номер списка доступа: ". $row['list_number'] ."<br>
                  Адрес электронной почты: ". $row['email'] ."<br>
                  Логин: ". $row['login'] ."<br>
    	          Имя ПК: ". $row['PC_name'] ."<br>
                  Операционная система: ". $row['OS'] ."<br>
                  ФИО: ". $row['FIO'] ."<br>
                  Подразделение: ". $row['squad'] ."<br>
                  Логирование: ". $row['logs'] ."<br>
                  Антивирус: ". $row['antivirus'] ."<br>
                  Доступ SSH: ". $row['SSH'] ."<br>
                  Доступ Webmin: ". $row['Webmin'] ."<br>
                  Доступ RDP: ". $row['RDP'] ."<br>
                  Производитель ПК: ". $row['PC_maker'] ."<br>
                  Модель ПК: ". $row['PC_model'] ."<br>
                  Серийный номер: ". $row['series_number'] ."<br>
                  Примечание: ". $row['others'] ."<hr>";
        }
    // Если данных нет
    } else {
        echo  ' <div class="nbd">Никто не найден</div>';
    }
}




?>
    <form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
        <p class="search">Поиск Пользователя: <input class="btn_fld"  type="text" name="search" id=""> <input class="btn1" type="submit" value="Поиск"></p>
        <hr>
    </form>
    <?php
    countPeople($result); // Функция вывода пользователей
    ?>


<div><a href="index.php"><h3>Старница администратора</h3></a></div>
<div><a href="work.php"><h3>Страница работы с пользователями</h3></a></div>
</body>
</html>
