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
    $cause=$date=$time="";
    $aid = $_SESSION['aid'];
    if (isset($_POST['cause'])) {
        $cause = test_input($_POST['cause']); 
    }if (isset($_POST['time1'])) {
        $time1 = test_input($_POST['time1']); 
    }if (isset($_POST['time2'])) {
        $time2 = test_input($_POST['time2']); 
    }if (isset($_POST['date'])) {
        $date = test_input($_POST['date']); 
    }if (isset($_POST['locid'])) {
        $locid = intval($_POST["locid"]); 
    }


    if (isset($_POST['gen_powercut'])) {
        global $con;
        $query="INSERT INTO powercut(`cause`,`time1`,`time2`,`date`,`locid`) VALUES('{$cause}','{$time1}','{$time2}','{$date}',{$locid})";
        if (!mysqli_query($con,$query))
        {
            die('Error: ' . mysqli_error($con));
        }
        }  
    
    header("Location:powercut.php");
?>