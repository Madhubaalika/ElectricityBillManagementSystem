<?php 
    require_once('head_html.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/admin.php'); 
    if ($logged==false) {
         header("Location:../dashboard.php");
    }
?>

<body>
    <div id="wrapper">
        <?php 
            require_once("nav.php");
            require_once("sidebar.php");
        ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Bills
                        </h1>
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#generated" data-toggle="pill">Bills History</a>
                            </li>
                            <li class=""><a href="#generate" data-toggle="pill">Generate New Bill</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="generated">                               
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Bill No.</th>
                                                <th>Customer</th>
                                                <th>Date</th>
                                                <th>UNITS Consumed</th>
                                                <th>Amount</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $id=$_SESSION['aid'];
                                            $query1 = "SELECT COUNT(user.name) FROM user,bill WHERE user.id=bill.uid AND aid={$id}";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging1.php");
                                            $result = retrieve_bills_generated($_SESSION['aid'],$offset, $rowsperpage);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td><?php echo 'BN_'.$row['bid']?></td>
                                                    <td height="50"><?php echo $row['user'] ?></td>
                                                    <td><?php echo $row['bdate'] ?></td>
                                                    <td><?php echo $row['units'] ?></td>
                                                    <td><?php echo '$'.$row['amount'] ?></td>
                                                    <td><?php echo $row['ddate'] ?></td>
                                                    <td><?php if($row['status'] == 'PENDING') { echo'<span class="badge" style="background: red;">'.$row["status"].'</span>'; } else { echo'<span class="badge" style="background: green;">'.$row["status"].'</span>';} ?></td>
                                                </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php include("paging2.php");  ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="generate">
                                    <?php
                                    $sql = "SELECT curdate1()";
                                    $result = mysqli_query($con,$sql);
                                    if($result === FALSE) {
                                        echo "FAILED";
                                        die(mysql_error()); 
                                    }
                                    $row = mysqli_fetch_row($result);
                                    if ($row[0] == 1) {
                                        include("generate_bill_table.php") ;
                                    }
                                    else
                                    {
										include("generate_bill_table.php") ;
                                    } 
                                    ?>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    require_once("footer.php");
    require_once("js.php");
    ?>
</body>
</html>

