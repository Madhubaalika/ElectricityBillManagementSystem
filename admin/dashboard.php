<?php 
    require_once('head.php'); 
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
            require_once("nav_bar.php");
        ?>
        <div id="page-content-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                            <small> Overview</small>
                        </h1>
                    </div>
                </div>
                <?php 
                    list($result1,$result2,) = retrieve_users_defaults($_SESSION['aid']);
                    $row1 = mysqli_fetch_row($result1);
                    $row2 = mysqli_fetch_row($result2);
                ?>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt" style="background-color:black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-warning fa-3x" style="color:white"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge" style="color:white"><b></b><?php echo $row1[0] ?></div>
                                        <div style="color:white">Late Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#late">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>ADD DUES</b></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2" style="background-color:black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-3x" style="color:white"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge" style="color:white"><b></b><?php echo $row2[0] ?></div>
                                        <div style="color:white">User Defaulting</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>REMOVE USER(s)</b></span>
                                    <span class="pull-right"><i class="fa fa-trash fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> 

                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2" style="background-color:black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-spinner fa-3x" style="color:white"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge" style="color:white"><b></b><?php include('pendingcount.php'); ?></div>
                                        <div style="color:white">Total Pending Bills</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting00">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>PENDING BILLS</b></span>
                                    <span class="pull-right"><i class="fa fa-spinner fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2" style="background-color:black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <span style="font-size:2em; color:white">₹</span>
                                    </div>
                                    <div class="col-md-9 text-right" style="color:white">
                                        <div class="huge"><b></b><?php include('billamtcount.php'); ?></div>
                                        <div>Total Transaction Amount</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting00">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>BILLS AMOUNT</b></span>
                                    <span class="pull-right"><span style="font-size:1.5em; color:mildblue">₹</span></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <?php 
                        list($result1,$result2,$result3) = retrieve_admin_stats($_SESSION['aid']);
                        $row1 = mysqli_fetch_row($result1);
                        $row2 = mysqli_fetch_row($result2);
                        $row3 = mysqli_fetch_row($result3);
                     ?>
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt" style="background-color:black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file fa-3x" style="color:white"></i>
                                    </div>
                                    <div class="col-md-9 text-right" style="color:white">
                                        <div class="huge"><b></b><?php echo $row2[0]; ?></div>
                                        <div>Generated Bills</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt" style="background-color:black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bullhorn fa-3x" style="color:white"></i>
                                    </div>
                                    <div class="col-md-9 text-right" style="color:white">
                                        <div class="huge" ><b></b><?php echo $row3[0]; ?></div>
                                        <div>Unprocessed Complaints</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                                <div class="modal fade" id="late" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title"><b>ADD DUES TO USERS</b></h3>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p><h4>ARE YOU SURE?</h4></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="dash_defaulting_users.php" method="post">                                               
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                                    <button type="submit" id="late_user" name="late_user" class="btn btn-success ">YES</button>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="defaulting" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title"><b>DELETE USERS</b></h3>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p><h4>ARE YOU SURE?</h4></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="dash_defaulting_users.php" method="post">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                                    <button type="submit" id="defaulting_user" name="defaulting_user" class="btn btn-success ">YES</button>
                                                </form>
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
