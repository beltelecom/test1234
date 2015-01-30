<?php
session_start();         
    if(isset($_POST['email'])){$email=$_POST['email'];if ($email == '') { unset($email);} } else {exit;}
    if(isset($_POST['pass'])){$pass=$_POST['pass']; if ($pass == '') { unset($pass);} } else {exit;}
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $email = trim($email);
    $pass = stripslashes($pass);
    $pass = htmlspecialchars($pass);
    $pass = trim($pass);
    if(strlen($pass)<8){echo "пороль менее 8 символов"; exit;}

    include_once ("bd.class.php");
    $con = new DB();
    $q="Select * From user Where name='$email'";
    //echo $q;
    $result = $con->query($q); 
    
    if ($result){
        if($con->query_count($result)==1){
            $rows=$con->fetch_assoc($result);
            //echo $rows['name']; 
            if($rows['pass']!=$pass){
                $_POST['err']="Ошибка автроризации"; exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php?err=11&err=1'></head></html>");}
            else{ $_SESSION['name']=$rows['name']; 
                  $_SESSION['id']=$rows['id'];
                  //echo "Вы авторизованы ".$_SESSION['name'];
                   exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php?err=11'></head></html>");
                                 }
        }else { $_POST['err']="Ошибка автроризации"; exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php?err=1'></head></html>");}
    } else {$_POST['err']="Ошибка автроризации"; exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php?err=11'></head></html>");}
    
    //echo $email." - ".$pass.":".strlen($pass);
?>