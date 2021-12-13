<?php
session_start();
$users = 'admin';
$pass = 'qwert';
        if($_POST['submit']){
                if($users == $_POST['user'] AND $pass == $_POST['pass'])
                {$_SESSION['admin'] = $users;
		header("Location: index.php");
                exit;
                }
                else echo '<p class="lg" > Login and password incorrect! </p>';
        }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
   <link rel="stylesheet" href="style.css">
 </head>
<center>
<h1 class="logo">Авторизация</h1>
</center>
<form action="" method="post">
<center>
<table class="table">
<tr>
  <td> username: <input type="text" name="user" /> </td>
</tr>
<tr>
  <td> password: <input type="text" name="pass" /> </td>
</tr>
<tr>
  <td> <input class="button" type="submit" name="submit" value"Login" /> </td>
</tr>
</table>
</center>
</form>
</html>

