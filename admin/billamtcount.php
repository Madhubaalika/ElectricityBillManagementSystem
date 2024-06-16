<?php 

include('../Includes/config.php');

$result = mysqli_query($con, 'SELECT SUM(totalbilled) AS value_sum FROM bill_summary'); 
$row = mysqli_fetch_assoc($result); 
echo '₹'.$sum = $row['value_sum'];

?>