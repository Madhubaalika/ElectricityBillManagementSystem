<?php 
    require_once ("../Includes/session.php") ;
    
?>

<nav class="navbar navbar-fixed-top"  style="background-color: black">
        <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard.php" style="color:white"><i class="fa fa-bolt"></i> E-Bill System</a> 
        </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="dashboard.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
                <li> <a href="users.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-users"></i> Customers </a></li>
                <li><a href="bill.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><span style="font-size:1em" >₹</span> Billings </a></li>
                <li><a href="complaints.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-info"></i> Complaints </a></li>
                <li><a href="lineman.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-phone"></i> Lineman </a></li>
                <li><a href="powercut.php" style="color:white" onmouseover="this.style.color='black';this.style.backgroundColor='lightblue'" onmouseout="this.style.color='white';this.style.backgroundColor='transparent'"><i class="fa fa-fw fa-power-off"></i> Powercut </a></li>
                <li class="dropdown">
            <?php 
                echo "<a href=\"#\" style=\"color:white\" onmouseover=\"this.style.color='black';this.style.backgroundColor='lightblue'\" onmouseout=\"this.style.color='white';this.style.backgroundColor='transparent'\"class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> ADMIN <b class=\"caret\"></b></a> ";
             ?>
            <ul class="dropdown-menu">
                <li class="divider"></li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
            </ul>
        </div>
    </nav>