<?php
	session_start();   
if (!empty($_SESSION['name']) or !empty($_SESSION['id'])) { 
    include_once ("bd.class.php");
    $con = new DB();
    $i=0;
    $email =$_SESSION['name'];
    $q="Select * From file Where user='$email'";
    $result = $con->query($q);
    if ($result){
       echo "<tr> <td>№</td> <td>File Name</td> <td>Size (kB)</td> </tr>"; 
       if($con->query_count($result)>0){
           $rows=$con->fetch_all($result);
             while($i<count($rows)) {
             $s= $rows[$i]['size']/1000;
             $j=$i+1;
             echo '<tr><td>'.$j.'</td><td>'.$rows[$i]['fileName'].'</td><td>'.$s.'</td></tr>';
             $i++;
           } 
          
       } else {
         echo "<tr> <td colspan='3'> У вас пока нет файлов </td> <td></td> <td></td> </tr>"; 
       } 
    }
}
?>