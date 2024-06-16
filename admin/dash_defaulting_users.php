<?php 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php');
    require_once('../Includes/admin.php');

    $aid = $_SESSION['aid'];
    list($result1,$result2,) = retrieve_users_defaults($_SESSION['aid']);
    $row1 = mysqli_fetch_row($result1);
    $row2 = mysqli_fetch_row($result2); 


    if (isset($_POST['defaulting_user'])) {
        $query  = "DELETE FROM users "; 
        $query .= "USING users , bills ";
        $query .= "WHERE bills.userid=users.id AND bills.status='PENDING' " ;
        $query .= "AND curdate() > adddate(bills.duedate , INTERVAL 25 DAY) " ;
        if (!mysqli_query($con,$query))
        {
                die('Error: ' . mysqli_error($con));
        }
    }

    elseif (isset($_POST['late_user'])) {
        $query  = "UPDATE transaction , bills , users ";
        $query .= "SET transaction.amount=transaction.amount + 165.00 "; 
        $query .= "WHERE bills.userid=users.id AND bills.status = 'PENDING' ";
        $query .= "AND curdate() > bills.duedate AND curdate() < adddate(bills.duedate , INTERVAL 25 DAY ) ";
        $query .= "AND transaction.billid=bills.billid AND transaction.amount=bills.amount ";

        if (!mysqli_query($con,$query))
        {
                die('Error: ' . mysqli_error($con));
        }
        
    }
    header("Location:dashboard.php");
?>