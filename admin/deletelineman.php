<?php 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php');
    require_once('../Includes/admin.php');
    $aid = $_SESSION['aid'];
    $id = intval($_POST['id']);
    if (isset($_POST['deletion'])) {
        $query  =  "DELETE FROM lineman WHERE lid={$id} ";

        if (!mysqli_query($con,$query))
        {
                die('Error: ' . mysqli_error($con));
        }
    }

    header("Location:lineman.php");
?>