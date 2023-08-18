<?php
   $servername='localhost';
   $username='root';
   $password='12345';
   $dbname = "db_ems";
   $link=mysqli_connect($servername,$username,$password,"$dbname");
   if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>