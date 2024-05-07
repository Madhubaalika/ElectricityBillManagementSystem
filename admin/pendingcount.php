<?php 

include('../Includes/config.php');

$sql = "SELECT * FROM bills WHERE status ='PENDING'";
                $query = $con->query($sql);
                echo "$query->num_rows";
?>