<?php 
require_once("Includes/config.php");
require_once("Includes/session.php");
if(isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == true)
    {
        if ($_SESSION['account']=="admin") {
                header("Location:admin/dashboard.php");
            }
        elseif ($_SESSION['account']=="user") {
                header("Location:user/dashboard.php");
            }
    }  
    else  {
        header("Location:../dashboard.php");
      }  
}

if(isset($_POST['login_submit'])) {
    if(!(isset($_POST['email']))) {
        if(!(isset($_POST['pass']))) {
            location('dashboard.php');    
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="mail-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="data:image/mail-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIKKCYiWgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIgKCYiuygmIhgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiJDKCYi7SgmIlIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiJzKCYi/SgmIqAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIgooJiKmKCYi/ygmIuAoJiIOAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIh8oJiLPKCYi/ygmIv4oJiI/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIkEoJiLrKCYi/ygmIv8oJiKMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmInAoJiL8KCYi/ygmIv8oJiL/KCYiySgmIpwoJiJzKCYiKQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIhYoJiJyKCYinCgmIsIoJiL8KCYi/ygmIv8oJiL/KCYinygmIgkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiJTKCYi/ygmIv8oJiL5KCYiaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIeKCYi7ygmIv8oJiLjKCYiNwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAoJiIDKCYimailCgmIv8oJiK+KCYiFQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKCYigigmIv8oJiKJKCYiAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKCYiPigmIvAoJiJSAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKCYiEigmIrooJiInAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACgmIlooJiIMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//8AAP/3AAD/7wAA/88AAP8fAAD+PwAA/D8AAPgfAAD4DwAA/j8AAPmail/AAD4/wAA8f8AAPf/AADv/wAA//8AAA==" rel="icon" type="image/mail-icon" />

    <title>EBMS</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>
<body>
    <div class="navbar navbar-default navbar-fimailed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="dashboard.php"><b>E-Bill System</b></a>
            </div>
            <div class="navbar-collapse collapse" >
                <?php include("login.php"); ?>
            </div>
        </div>
    </div>
   < <div id="headerwrap">
        <div class="darkhearderwrap">
            <div class="container">
                <div class="row">
                        <h1>Electricity Bill Management System</h1> 
                        <h1>Sign Up</h1>
                        <?php include("signup.php"); ?>
                </div>
            </div>  
            </div>
    </div> 
    <?php 
    require_once("footer.php");
    ?>
    <script src="assets/js/jquery-1.11.0.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
    function Validate_Form() {
            var mail = document.forms["myForm"]["email"].value;
            var at_pos = mail.dashboardOf("@");
            var dot_pos = mail.lastdashboardOf(".");
            if (at_pos< 1 || dot_pos<at_pos+2 || dot_pos+2>=mail.length) {
                alert("Not a valid e-mail address");
                return false;
            }
        }  </script> 
</body>
</html>
