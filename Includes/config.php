<?php
    $host='localhost'; 
    $mysql_user="root";
    $mysql_pwd=""; 
    $dbms="ebsystem"; 

    $con = mysqli_connect($host,$mysql_user,$mysql_pwd,$dbms);
    if (!$con) die('Could not connect: '. mysqli_error());
    mysqli_select_db($con,$dbms) or die("Cannot select DB" . mysqli_error());
?>