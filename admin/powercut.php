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
                            Scheduling Powercuts
                        </h1>
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#generated" data-toggle="pill">Powercuts scheduled</a>
                            </li>
                            <li class=""><a href="#generate" data-toggle="pill">New scheduled Powercut</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="generated">                               
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                        <th>Powercut Id</th>
                                        <th>Cause</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Date</th>
                                        <th>Location Id(pincode)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $id=$_SESSION['aid'];
                                            $query1 = "SELECT COUNT(*) FROM powercut  ";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging_1.php");
                                            $result = retrieve_powercut_information($_SESSION['aid'],$offset, $rowsperpage);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                        <tr>
                                            <td height="50"><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['cause'] ?></td>
                                            <td><?php echo $row['time1'] ?></td>
                                            <td><?php echo $row['time2'] ?></td>
                                            <td><?php echo $row['date'] ?></td>
                                            <td><?php echo $row['pincode'] ?></td>
                                        </tr>
                                    <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php include("paging_2.php");  ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="generate">
                                    
									<?php	include("generate_powercut.php") ;?>
                                    
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