<?php
session_start();	
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
	<meta name="author" content="Denis" />
  	<title>Test      </title>
    <link href="style11.css" rel="stylesheet" type="text/css" />
        <script language="javascript" type="text/javascript" src="js/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="js/func.js"></script>
    </head>
<body> 
<?php

	if (empty($_SESSION['name']) or empty($_SESSION['id'])) { 
?>
<div class="popup__overlay">
        <div class="popup">
            <a href="#" class="popup__close">X</a>
            <h2>LogIn</h2>
            <form action="reg_user.php" method="post">
            <span>Email   : <input name="email" type="email" placeholder="Адрес Email" autofocus /></span>
            <span>Password: <input name="pass" type="password" pattern="[A-Za-z0-9_-]{8,55}" placeholder="Пароль" /> </span>
            <input type="submit" name="submit" value="LogIn">
            </form>
            <?php 
            if (isset($_GET['err'])){echo "Ошибка авторизации" ;}
             ?>
</div>
<?php
  }	else { echo "<div id='user'> Вы вошли как ".$_SESSION['name'];?>
            
            <a href='exit.php' >LogOut</a>
            
            </div>
  
  
    <div id="left">
        <h2>Ваши файлы...</h2>
        <table id="tab">
        <?php include "file.php"; ?>
        </table>
       <script language="javascript" type="text/javascript" >
       
       </script>
    </div>
    <div id="right">
        <h2>Загрузка Файлов</h2>
            <form enctype="multipart/form-data" action="upload_file.php" method="post">
                    <span> Выберите файл <input type="file" name="filename" value="файл" /></span>
                    <br /><input id="up" type="submit" name="submit" value="Upload">
            </form>
    </div>
  
  
  
<?php }?>
</body>
</html>
