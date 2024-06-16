<?php 
    require_once('head.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/user.php'); 
    if ($logged==false) {
         header("Location:../dashboard.php");
    }
?>
<body>
    <div id="wrapper">
       <?php 
            require_once("nav_bar.php");
        ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Transaction
                        </h1>
                        <ol class="breadcrumb">
                          <li>Transaction</li>
                          <li class="active">History</li>
                        </ol>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Transaction No.</th>
                                        <th>Bill Date</th>
                                        <th>Amount</th>
                                        <th>Dues (if any)</th>
                                        <th>Final Amount Payed</th>
                                        <th>Transaction Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $id=$_SESSION['uid'];
                                    $query1 = "SELECT COUNT(*) FROM bills , transaction WHERE transaction.billid=bills.billid AND bills.userid={$id}  ";
                                    $result1 = mysqli_query($con,$query1);
                                    $row1 = mysqli_fetch_row($result1);
                                    $numrows = $row1[0];
                                    include("paging_1.php");
                                    $result = retrieve_transaction_history($_SESSION['uid'],$offset, $rowsperpage);
                                    while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    if($row['paydate']!=NULL) echo 'TRN_'.$row['id'] ;
                                                    else echo "-";
                                                 ?>
                                            </td>
                                            <td height="50"><?php echo $row['billdate'] ?></td>
                                            <td><?php echo '₹'.$row['amount'] ?></td>
                                            <td><?php echo '₹'.$row['dues'] ?></td>
                                            <td><?php echo '₹'.$row['payable'] ?></td>
                                            <td>
                                                <?php 
                                                    if($row['paydate']!=NULL) echo $row['paydate'];
                                                    else echo "TRANSACTION PENDING";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php include("paging_2.php");  ?>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
    <?php 
    require_once("footer.php");
    require_once("javascript.php");
    ?>
    
</body>

</html>
