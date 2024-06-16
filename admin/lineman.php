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
                            Available Linemen
                        </h1>
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#delete" data-toggle="pill">Deletion</a>
                            </li>
                            <li class=""><a href="#generate" data-toggle="pill">Insertion</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="delete">                               
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Lineman Id.</th>
                                                <th>Name</th>
                                                <th>Contact No</th>
                                                <th>Location Id</th>
                                                <th>DELETE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $id=$_SESSION['aid'];
                                            $query1 = "SELECT COUNT(lineman.lid) FROM lineman";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging_1.php");
                                            $result = retrieve_lineman_information($_SESSION['aid'],$offset, $rowsperpage);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <form action="deletelineman.php" method="post"> 
                                                    <input type="hidden" name="id" value=<?php echo $row['id'] ?> >
                                                    <td td height="50"><?php echo $row['id'] ?></td>                                             
                                                    <input type="hidden" name="name" value=<?php echo $row['name'] ?> >
                                                    <td td height="50"><?php echo $row['name'] ?></td>
                                                    <input type="hidden" name="phone" value=<?php echo $row['phone'] ?> >
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <input type="hidden" name="pincode" value=<?php echo $row['pincode'] ?> >
                                                    <td><?php echo $row['pincode'] ?></td>
                                                    <td>
                                                    <button class="btn btn-success form-control" data-toggle="modal"  data-target="#del">DELETE</button>
                                                    </td>
                                                    <div class="modal fade" id="del" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                    <h3 class="modal-title text-centre"><b>Delete</b></h3>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <h4>Are You Sure?</h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Later</button>
                                                                        <button type="submit" id="deletion" name="deletion" class="btn btn-success ">delete</button>
                                                    </form> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php include("paging_2.php");  ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="generate">
                                    
									<?php	include("addlineman.php") ;?>
                                    
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
