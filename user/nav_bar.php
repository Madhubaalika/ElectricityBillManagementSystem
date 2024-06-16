 <?php 
    require_once ("../Includes/session.php") ;
    if (isset($_SESSION['user'])) 
    {
        $user = $_SESSION['user'];
        $email = $_SESSION['email'];
    }
    else
        header("../dashboard.php");
?>


 <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard.php" style="color:white"><i class="fa fa-bolt"></i> E-Bill System</a> 
        </div>
            <ul class="nav navbar-nav navbar-right" >
                <li><a href="dashboard.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
                <li><a href="bill.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><span style="font-size:1em" >₹</span> Bills </a></li>
                <li><a href="transaction.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-table"></i> Transactions </a></li>
                <li><a href="complaints.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-info"></i> Complaints </a></li>
                <li><a href="lineman.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-phone"></i> Lineman </a></li>
                <li><a href="powercut.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-power-off"></i> Powercut </a></li>

                <li class="dropdown">
            <?php 
                echo "<a style=\"font-size:16px;color:white\" href=\"#\" onmouseover=\"this.style.color='black';this.style.backgroundColor='lightblue'\" onmouseout=\"this.style.color='white';this.style.backgroundColor='transparent'\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\" ></i> $user <b class=\"caret\"></b></a> ";
             ?>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" data-toggle="modal" data-target="#profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
            </ul>
        </div>
    </nav>
    <?php 
    require_once("../Includes/user.php");
    $result = retrieve_user_details($_SESSION['uid']);
    $row = mysqli_fetch_assoc($result);
 ?>
<div class="modal fade" id="profile" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title"><b><i class="fa fa-fw fa-user"></i>PROFILE</b></h3>
            </div>
        <div class="modal-body text-center">
            <h4>Name : <code><?php echo $user ?></code></h4>
            <h4>Email : <code><?php echo $email ?></code></h4>
      
        </div>
        </div>
    </div>
</div>