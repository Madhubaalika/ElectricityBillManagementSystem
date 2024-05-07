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
            require_once("nav_bar.php");
            require_once("side_bar.php");
        ?>

        <div id="page-content-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Customer
                            <small>Details</small>
            
                        </h1>
                        <ol class="breadcrumb">
                          <li>User</li>
                          <li class="active">Details</li>
                        </ol>
                        <div class="table-responsive" style="padding-top: 0">
                                <table class="table table-hover table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                            $id=$_SESSION['adminid'];
                                            $query1 = "SELECT COUNT(*) FROM users";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging_1.php");
                                           
                                            $result = retrieve_users_detail($_SESSION['adminid'],$offset, $rowsperpage);

                                            $cnt=1;
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td height="50"><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['address'] ?></td>                                                    
                                                </tr>
                                            <?php $cnt++; } ?>
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