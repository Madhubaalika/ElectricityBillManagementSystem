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
                            Complaints
                        </h1>
                        <ol class="breadcrumb">
                          <li>Complaint</li>
                          <li class="active">Not Processed</li>
                        </ol>
                        </div>
                    </div>
                            <div class="table-responsive" style="padding-top: 0">
                                <table class="table table-hover table-striped table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Complaint No.</th>
                                            <th>User</th>
                                            <th>Complaint</th>
                                            <th>Status</th>
                                            <th>Process</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $id=$_SESSION['aid'];
                                            $query1 = "SELECT COUNT(complaint.id) FROM users,complaint  ";
                                            $query1.= " WHERE complaint.userid=users.id AND status='NOT PROCESSED' AND complaint.adminid={$id}";
                                            $result1 = mysqli_query($con,$query1);
                                            $row1 = mysqli_fetch_row($result1);
                                            $numrows = $row1[0];
                                            include("paging_1.php");
                                            $result = retrieve_complaints_history($_SESSION['aid'],$offset, $rowsperpage);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td><?php echo 'CA-'.$row['id'] ?></td>
                                                    <td height="50"><?php echo $row['uname'] ?></td>
                                                    <td><?php echo $row['complaint'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td width="70">
                                                    <form action="process_complaint.php" method="post">
                                                        <input type="hidden" name="cid" value=<?php echo $row['id'] ?> >
                                                        <button type="submit" name="complaint_process" class="btn btn-success form-control">PROCESS COMPLAINT  </button>
                                                    </form>
                                                        
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
        </div>
    </div>
 <?php 
    require_once("footer.php");
    require_once("javascript.php");
?>
</body>
</html>
