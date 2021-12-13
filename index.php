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
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="style.css">
</head>
<body>
<title>Главная страница</title>
<center>
<h1>Страница администратора</h1>
</center>
<div class="list">
<p>1. Номер кабинета: 17</p>
<p>2. Номер сетевой розетки: 42/13</p>
<p>3. Номер порта коммутатора: 8080</p>
<p>4. MAC-адрес: 7e:83:0a:33:50:1c</p>
<p>5. Привязка: да</p>
<p>6. IP-адрес: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
<p>7. IP-адреса используемых DNS: 215.157.46.120, 216.158.47.121</p>
<p>8. IP-адреса используемых NTP: 132.163.96.5, 132.163.97.5</p>
<p>9. Номер списка доступа: 123</p>
<p>10. Адрес электронной почты: example@mail.ru</p>
<p>11. Логин: admin</p>
<p>12. Имя ПК: Komp-23/47</p>
<p>13. Операционная система: Linux</p>
<p>14. ФИО: Иванов Иван Иванович</p>
<p>15. Подразделение: 1</p>
<p>16. Логирование: да</p>
<p>17. Антивирус: Kaspersky antivirus</p>
<p>18. Доступ SSH: да</p>
<p>19. Доступ Webmin: да</p>
<p>20. Доступ RDP: да</p>
<p>21. Производитель ПК: Lenovo</p>
<p>22. Модель ПК: ThinkPad T15 Gen 2</p>
<p>23. Серийный номер: DY30-008MRT<p>
<p>24. Примечание: -</p>
</div>
<a  href="static.php"><h3>Страница статистики о пользователях</h3></a>
</body>
</html>
