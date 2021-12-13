<?php
session_start();
        if($_SESSION['admin'] != "admin"){
                header("Location: login.php");
                exit;
        }
?>



<!doctype html>
<html lang="ru">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Работа с пользователями</title>
</head>
<center>
<h1>Информация о пользователях</h1>
</center>
<body class="last">
  <?php
    $host = 'localhost';  //Адрес сервера
    $user = 'root';    // Имя пользователя
    $pass = 'debian'; // Пароль
    $db_name = 'web';   // Имя базы данных
    $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с БД

    // Если соединение установить не удалось
    if (!$link) {
      echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
      exit;
    }

    //Если переменная Name передана
    if (isset($_POST["cabinet"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $sql = mysqli_query($link, "UPDATE `users` SET `cabinet` = '{$_POST['cabinet']}',`set_rosette` = '{$_POST['set_rosette']}',`switch_port` = '{$_POST['switch_port']}',`MAC_address` = '{$_POST['MAC_address']}',`binding` = '{$_POST['binding']}',`IP_address` = '{$_POST['IP_address']}',`dns` = '{$_POST['dns']}',`ntp` = '{$_POST['ntp']}',`list_number` = '{$_POST['list_number']}',`email` = '{$_POST['email']}',`login` = '{$_POST['login']}',`PC_name` = '{$_POST['PC_name']}',`OS` = '{$_POST['OS']}',`FIO` = '{$_POST['FIO']}',`squad` = '{$_POST['squad']}',`logs` = '{$_POST['logs']}',`antivirus` = '{$_POST['antivirus']}',`SSH` = '{$_POST['SSH']}',`Webmin` = '{$_POST['Webmin']}',`RDP` = '{$_POST['RDP']}',`PC_maker` = '{$_POST['PC_maker']}',`PC_model` = '{$_POST['PC_model']}',`series_number` = '{$_POST['series_number']}',`others` = '{$_POST['others']}' WHERE `ID`={$_GET['red_id']}");
      } else {
          //Иначе вставляем данные, подставляя их в запрос
          $sql = mysqli_query($link, "INSERT INTO `users` (`cabinet`, `set_rosette`, `switch_port`, `MAC_address`, `binding`, `IP_address`, `dns`, `ntp`, `list_number`, `email`, `login`, `PC_name`, `OS`, `FIO`, `squad`, `logs`, `antivirus`, `SSH`, `Webmin`, `RDP`, `PC_maker`, `PC_model`, `series_number`, `others`) VALUES ('{$_POST['cabinet']}', '{$_POST['set_rosette']}', '{$_POST['switch_port']}', '{$_POST['MAC_address']}', '{$_POST['binding']}', '{$_POST['IP_address']}', '{$_POST['dns']}', '{$_POST['ntp']}', '{$_POST['list_number']}', '{$_POST['email']}', '{$_POST['login']}', '{$_POST['PC_name']}', '{$_POST['OS']}', '{$_POST['FIO']}', '{$_POST['squad']}', '{$_POST['logs']}', '{$_POST['antivirus']}', '{$_POST['SSH']}', '{$_POST['Webmin']}', '{$_POST['RDP']}', '{$_POST['PC_maker']}', '{$_POST['PC_model']}', '{$_POST['series_number']}', '{$_POST['others']}')");
      }

      //Если вставка прошла успешно
      if ($sql) {
        echo '<p>Успешно!</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $sql = mysqli_query($link, "DELETE FROM `users` WHERE `ID` = {$_GET['del_id']}");
      if ($sql) {
        echo "<p>Пользователь удален.</p>";
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }

    //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
    if (isset($_GET['red_id'])) {
      $sql = mysqli_query($link, "SELECT `ID`, `cabinet`, `set_rosette`, `switch_port`, `MAC_address`, `binding`, `IP_address`, `dns`, `ntp`, `list_number`, `email`, `login`, `PC_name`, `OS`, `FIO`, `squad`, `logs`, `antivirus`, `SSH`, `Webmin`, `RDP`, `PC_maker`, `PC_model`, `series_number`, `others` FROM `users` WHERE `ID`={$_GET['red_id']}");
      $product = mysqli_fetch_array($sql);
    }
  ?>
  <form action="" method="post">
    <table>
      <tr>
        <td>Номер кабинета:</td>
        <td><input type="text" name="cabinet" size="10" value="<?= isset($_GET['red_id']) ? $product['cabinet'] : ''; ?>"></td>
        <td>Номер сетевой розетки:</td>
        <td><input type="text" name="set_rosette" size="10" value="<?= isset($_GET['red_id']) ? $product['set_rosette'] : ''; ?>"> </td>
        <td>Номер порта коммутатора:</td>
        <td><input type="text" name="switch_port" size="10" value="<?= isset($_GET['red_id']) ? $product['switch_port'] : ''; ?>"> </td>
        <td>MAC-адрес:</td>
        <td><input type="text" name="MAC_address" size="10" value="<?= isset($_GET['red_id']) ? $product['MAC_address'] : ''; ?>"> </td>
      </tr>
      <tr>
        <td>Привязка:</td>
        <td><input type="text" name="binding" size="10" value="<?= isset($_GET['red_id']) ? $product['binding'] : ''; ?>"> </td>
        <td>IP-адрес:</td>
        <td><input type="text" name="IP_address" size="10" value="<?= isset($_GET['red_id']) ? $product['IP_address'] : ''; ?>"> </td>
        <td>IP-адрес используемого DNS:</td>
        <td><input type="text" name="dns" size="10" value="<?= isset($_GET['red_id']) ? $product['dns'] : ''; ?>"> </td>
        <td>IP-адрес используемого NTP:</td>
        <td><input type="text" name="ntp" size="10" value="<?= isset($_GET['red_id']) ? $product['ntp'] : ''; ?>"> </td>
      </tr>
      <tr>
        <td>Номер списка доступа:</td>
        <td><input type="text" name="list_number" size="10" value="<?= isset($_GET['red_id']) ? $product['list_number'] : ''; ?>"> </td>
        <td>Адрес электронной почты:</td>
        <td><input type="text" name="email" size="10" value="<?= isset($_GET['red_id']) ? $product['email'] : ''; ?>"> </td>
        <td>Логин:</td>
        <td><input type="text" name="login" size="10" value="<?= isset($_GET['red_id']) ? $product['login'] : ''; ?>"> </td>
        <td>Имя ПК:</td>
        <td><input type="text" name="PC_name" size="10" value="<?= isset($_GET['red_id']) ? $product['PC_name'] : ''; ?>"> </td>
      </tr>
      <tr>
        <td>Операционная система:</td>
        <td><input type="text" name="OS" size="10" value="<?= isset($_GET['red_id']) ? $product['OS'] : ''; ?>"> </td>
        <td>ФИО:</td>
        <td><input type="text" name="FIO" size="10" value="<?= isset($_GET['red_id']) ? $product['FIO'] : ''; ?>"> </td>
        <td>Подразделение:</td>
        <td><input type="text" name="squad" size="10" value="<?= isset($_GET['red_id']) ? $product['squad'] : ''; ?>"> </td>
        <td>Логирование:</td>
        <td><input type="text" name="logs" size="10" value="<?= isset($_GET['red_id']) ? $product['logs'] : ''; ?>"> </td>
      </tr>
      <tr>
        <td>Антивирус:</td>
        <td><input type="text" name="antivirus" size="10" value="<?= isset($_GET['red_id']) ? $product['antivirus'] : ''; ?>"> </td>
        <td>Доступ SSH:</td>
        <td><input type="text" name="SSH" size="10" value="<?= isset($_GET['red_id']) ? $product['SSH'] : ''; ?>"> </td>
        <td>Доступ Webmin:</td>
        <td><input type="text" name="Webmin" size="10" value="<?= isset($_GET['red_id']) ? $product['Webmin'] : ''; ?>"> </td>
        <td>Доступ RDP:</td>
        <td><input type="text" name="RDP" size="10" value="<?= isset($_GET['red_id']) ? $product['RDP'] : ''; ?>"> </td>
      </tr>
      <tr>
        <td>Производитель ПК:</td>
        <td><input type="text" name="PC_maker" size="10" value="<?= isset($_GET['red_id']) ? $product['PC_maker'] : ''; ?>"> </td>
        <td>Модель ПК:</td>
        <td><input type="text" name="PC_model" size="10" value="<?= isset($_GET['red_id']) ? $product['PC_model'] : ''; ?>"> </td>
        <td>Серийный номер:</td>
        <td><input type="text" name="series_number" size="10" value="<?= isset($_GET['red_id']) ? $product['series_number'] : ''; ?>"> </td>
        <td>Примечание:</td>
        <td><input type="text" name="others" size="10" value="<?= isset($_GET['red_id']) ? $product['others'] : ''; ?>"> </td>
      </tr>
      <tr>
        <td colspan="2"><input class="btn4" type="submit" value="OK"></td>
      </tr>
    </table>
  </form>
  <table border='1'>
    <tr>
      <td>Идентификатор</td>
      <td>Кабинет</td>
      <td>Сеть</td>
      <td>Порт</td>
      <td>MAC-адрес</td>
      <td>Привязка</td>
      <td>IP-адрес</td>
      <td>IP-адрес DNS</td>
      <td>IP-адрес NTP</td>
      <td>Номер списка доступа</td>
      <td>Почта</td>
      <td>Логин</td>
      <td>Имя ПК</td>
      <td>ОС</td>
      <td>ФИО</td>
      <td>Подразделение</td>
      <td>Логирование</td>
      <td>Антивирус</td>
      <td>Доступ SSH</td>
      <td>Доступ Webmin</td>
      <td>Доступ RDP</td>
      <td>Производитель ПК</td>
      <td>Модель ПК</td>
      <td>Серийный номер</td>
      <td>Примечание</td>
      <td>Удаление</td>
      <td>Редактирование</td>
    </tr>
    <?php
      $sql = mysqli_query($link, 'SELECT `ID`, `cabinet`, `set_rosette`, `switch_port`, `MAC_address`, `binding`, `IP_address`, `dns`, `ntp`, `list_number`, `email`, `login`, `PC_name`, `OS`, `FIO`, `squad`, `logs`, `antivirus`, `SSH`, `Webmin`, `RDP`, `PC_maker`, `PC_model`, `series_number`, `others` FROM `users`');
      while ($result = mysqli_fetch_array($sql)) {
        echo '<tr>' .
             "<td>{$result['ID']}</td>" .
             "<td>{$result['cabinet']}</td>" .
             "<td>{$result['set_rosette']}</td>" .
             "<td>{$result['switch_port']}</td>" .
             "<td>{$result['MAC_address']}</td>" .
             "<td>{$result['binding']}</td>" .
             "<td>{$result['IP_address']}</td>" .
             "<td>{$result['dns']}</td>" .
             "<td>{$result['ntp']}</td>" .
             "<td>{$result['list_number']}</td>" .
             "<td>{$result['email']}</td>" .
             "<td>{$result['login']}</td>" .
             "<td>{$result['PC_name']}</td>" .
             "<td>{$result['OS']}</td>" .
             "<td>{$result['FIO']}</td>" .
             "<td>{$result['squad']}</td>" .
             "<td>{$result['logs']}</td>" .
             "<td>{$result['antivirus']}</td>" .
             "<td>{$result['SSH']}</td>" .
             "<td>{$result['Webmin']}</td>" .
             "<td>{$result['RDP']}</td>" .
             "<td>{$result['PC_maker']}</td>" .
             "<td>{$result['PC_model']}</td>" .
             "<td>{$result['series_number']}</td>" .
             "<td>{$result['others']}</td>" .
             "<td><a href='?del_id={$result['ID']}'>Удалить</a></td>" .
             "<td><a href='?red_id={$result['ID']}'>Изменить</a></td>" .
             '</tr>';
      }
    ?>
  </table>
  <p><a href="?add=new"><h2>Добавить нового пользователя</h2></a></p>
  <div><a href="static.php"><h3>Страница статистики</h3></a></div>
</body>
</html>