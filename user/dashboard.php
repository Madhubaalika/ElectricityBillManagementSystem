<?php 
    require_once('head.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/user.php'); 

    if ($logged==false) {
         header("Location:../dashboard.php");
    }
?>
<style>
    .panel-bolt {
    border-color:#000000;
}
.panel-bolt .panel-heading {
    border-color:#000000;
    color: #fff;
    background-color:#000000;
}
.bi-currency-rupee {
    color: #ffffff !important;
}

</style>
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
                            Dashboard
                        </h1>
                        <?php
                            require_once("../Includes/session.php");
                            require_once("../Includes/config.php");
                        ?>
                        <div class="row" style="margin-top: 20px;">

                            <?php 
                                $id=$_SESSION['uid'];
                                global $con;
                                list($result1,$result2,$result3) = retrieve_user_stats($_SESSION['uid']);
                                $q1="SELECT Unpaid_amount({$id}) FROM DUAL";
                                $result4=mysqli_query($con,$q1);
                                $q2="SELECT total_powercuts FROM powercut_summary p,users u WHERE u.pincode=p.locid and u.id={$id}";
                                $result5=mysqli_query($con,$q2);
                                $row1 = mysqli_fetch_row($result1);
                                $row2 = mysqli_fetch_row($result2);
                                $row3 = mysqli_fetch_row($result3);
                                $row4=mysqli_fetch_row($result4);
                                $row5=mysqli_fetch_row($result5);
                             ?>

                            <div class="col-lg-4 col-xs-6">
                                <div class="panel panel-bolt">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <span style="font-size:2em; color:white">₹</span>  
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge"><?php echo $row2[0]; ?></div>
                                                <div>Payed Bills</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-6">
                                <div class="panel panel-bolt">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-fw fa-list-alt" style="font-size:2em" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge"><?php echo $row1[0]; ?></div>
                                                <div>Pending Bills</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-6">
                                <div class="panel panel-bolt">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-bullhorn fa-3x"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge"><?php echo $row3[0]; ?></div>
                                                <div>Unprocessed Complaints</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-6">
                                <div class="panel panel-bolt">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-fw fa-power-off" style="font-size:2em" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge"><?php echo $row5[0]; ?></div>
                                                <div>Powercuts</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xs-6">
                                <div class="panel panel-bolt">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <span style="font-size:2em; color:white">₹</span>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge"><?php echo $row4[0]; ?></div>
                                                <div>Unpaid amount</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
