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
                            Available Linemen
                        </h1>
                        <ol class="breadcrumb">
                          <li>Linemen</li>
                          <li class="active">Contact Info</li>
                        </ol>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Lineman Id</th>
                                        <th>Name</th>
                                        <th>Phone No</th>
                                        <th>Location Id(pincode)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $id=$_SESSION['uid'];
                                    $query1 = "SELECT COUNT(*) FROM users , location, lineman WHERE users.pincode=location.id AND users.id={$id} AND location.id=lineman.locid  ";
                                    $result1 = mysqli_query($con,$query1);
                                    $row1 = mysqli_fetch_row($result1);
                                    $numrows = $row1[0];
                                    include("paging_1.php");
                                    $result = retrieve_lineman_info($_SESSION['uid'],$offset, $rowsperpage);
                                    while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <tr>
                                            <td height="50"><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php echo $row['pincode'] ?></td>
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
