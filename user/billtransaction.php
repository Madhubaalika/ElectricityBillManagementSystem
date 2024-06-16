<?php 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php');
    require_once('../Includes/user.php');
    $uid = $_SESSION['uid'];
    $bdate = $_POST['bdate'];
    $ddate = $_POST['ddate'];
    $units = $_POST['units'];
    $amount = $_POST['amount'];
    $payable = $_POST['payable'];
    $id=$_POST['id'];
    if (isset($_POST['pay_bill'])) {
        $query  =  "UPDATE bills ";
        $query .=  "SET status='PAID' ";
        $query .=  " where amount={$amount} AND billid={$id}" ;

        if (!mysqli_query($con,$query))
        {
                die('Error: ' . mysqli_error($con));
        }
    }

    header("Location:bill.php");
?>