<?php
session_start();   
if (!empty($_SESSION['name']) or !empty($_SESSION['id'])) { 	
    if($_FILES["filename"]["size"] > 1024*100*1024)
   {
     echo ("Размер файла превышает 100 мегабайт");
     exit;
   } else {
 $today = date("F j, Y, g:i a");
 $namefile=$_FILES['filename']['name'];
 $user = $_SESSION['name'];
 $size= $_FILES["filename"]["size"];
 
 $uploaddir = 'file/';
 $uploadfile = $uploaddir.basename($_FILES['filename']['name']);

 if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
    include_once ("bd.class.php");
    $con = new DB();
    $set="fileName='$namefile',user='$user',size='$size'"; echo $set;
    $res= $con->insert_record('file',$set);
    exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}
 }
}
?>