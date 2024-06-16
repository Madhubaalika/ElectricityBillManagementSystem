<?php
require_once("Includes/session.php");
$nameErr =  $addrErr = $emailErr = $passwordErr = $confpasswordErr = $pincodeErr = "";
$name = $email = $password = $confpassword = $address = $pincode =  "";
$flag=0;
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
if(isset($_POST["reg_submit"])) {
        $email = test_input($_POST['email']); 
        $password = test_input($_POST["inputPassword"]);
        $confpassword = test_input($_POST["confirmPassword"]);
        $address = test_input($_POST["address"]);
        $email = test_input($_POST['email']);
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $flag=1;
            echo $nameErr;
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed"; 
                $flag=1;
                echo $nameErr;
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $flag=1;
            } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
                $flag=1;
                echo $emailErr;
            }
        }
        if (empty($_POST["inputPassword"])) 
        {
            $passwordErr = "PASSWORD missing";
            $flag=1;
        }
        else 
        {
            $password = $_POST["inputPassword"];
        }
        if (empty($_POST["confirmPassword"])) 
        {
            $confpasswordErr = "missing";
            $flag=1;
        }
        else 
        {
            if($_POST['confirmPassword'] == $password)
            {
                $confpassword = $_POST["confirmPassword"];
            }
            else
            {
                $confpasswordErr = "Not same as password!";
                $flag = 1;
            }
        }
        if (empty($_POST["address"])) {
            $addrErr = "Address is required";
            $flag=1;
            echo $addrErr;
        } else {
            $address = test_input($_POST["address"]);
        }
       
        if(empty($_POST["pincode"])){
            $pincodeErr = "Pincode is required";
            $flag=1;
            echo $pincodeErr;
            $pincode = "";
        }
        else{
            $pincode = filter_var($_POST["pincode"], FILTER_VALIDATE_INT);
            if ($pincode === false) {
                $pincodeErr = "Pincode must be a valid integer.";
                echo $pincodeErr;
                $flag = 1;
            } else {
            $pincode = test_input($pincode);
            if(!preg_match("/^\d{6}$/", $_POST["pincode"])){
                $pincodeErr="6 digits required.";
                echo $pincodeErr;
                $flag=1;
            }
            $c=0;
            $sqlquery = "SELECT id FROM location";
            $res = mysqli_query($con, $sqlquery);
            $pincode = test_input($_POST["pincode"]);
            while($locid=mysqli_fetch_assoc($res)){
                if((int)$locid['id']===(int)$pincode)
                    {
                        $c=1;
                        break;
                    }
            }
            if($c===0){
                $pincodeErr="Enter valid pincode.";
                echo $pincodeErr;
                $flag=1;
            }
        }
        }
        echo $flag; 
        if($flag == 0)
        {
            require_once("Includes/config.php");
            $sql = "INSERT INTO users (`name`,`email`,`password`,`address`,`pincode`)
                    VALUES('$name','$email','$password','$address','$pincode')";
                    echo $sql;
            if (!mysqli_query($con,$sql))
            {
                die('Error: ' . mysqli_error($con));
            }
            header("Location:dashboard.php");
        }
    }
?>
<form action="signup.php" method="post" class="form-horizontal" role="form" onsubmit="return Validate_Form()">
<center>
    <div class="row form-group">
        <div class="col-md-12">
            <input type="name" class="form-control" name="name" id="name" placeholder="Full Name" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <input type="address" class="form-control" name="address" placeholder="Address" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="text" class="form-control" name="pincode" placeholder="Pincode" maxlength="6" required>
        </div>
    </div>
    <div class="form-group">
       <div class="col-md-10">
            <button name="reg_submit" class="btn btn-primary">Sign Up</button>
        </div>
    </div>
    </center>
</form>
