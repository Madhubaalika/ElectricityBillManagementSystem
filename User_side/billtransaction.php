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
    if (isset($_POST['pay_bill'])) {
        $query  =  "UPDATE users , bills , transaction ";
        $query .=  "SET bills.status='PROCESSED' , transaction.status='PROCESSED' , paymentdate=curdate() ";
        $query .=  "where users.id={$uid} AND bills.billid=transaction.id AND bills.units={$units} "; 
        $query .=  "AND bills.amount={$amount} AND transaction.amount={$payable}" ;

        if (!mysqli_query($con,$query))
        {
                die('Error: ' . mysqli_error($con));
        }
    }

    header("Location:bill.php");
?>