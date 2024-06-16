<?php 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php');
    require_once('../Includes/admin.php');
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $name=$phone="";
    $aid = $_SESSION['aid'];
    if (isset($_POST['name'])) {
        $name = test_input($_POST['name']); 
    }if (isset($_POST['phone'])) {
        $phone = test_input($_POST['phone']); 
    }if (isset($_POST['locid'])) {
        $locid = intval($_POST["locid"]); 
    }


    if (isset($_POST['gen_lineman'])) {
        global $con;
        $query="INSERT INTO lineman(`name`,`phone`,`locid`) VALUES('{$name}','{$phone}',{$locid})";
        if (!mysqli_query($con,$query))
        {
            die('Error: ' . mysqli_error($con));
        }
        }  
    
    header("Location:lineman.php");
?>