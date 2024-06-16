    <?php 
    include("../Includes/session.php");
    include("../Includes/config.php");
    $id=$_SESSION['uid'];
    $comp=$_POST["complaint"];
    $aid=rand(1,2);
    $stat="NOT PROCESSED";
    if(isset($_POST["complaint"]) && !empty($_POST["complaint"]))
    {
        $query  = "call Add_Complaint({$id},{$aid},'{$comp}','{$stat}')";
        mysqli_query($con,$query);
    }

    header("Location:complaints.php");   
    ?>