    <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>USER</th>
                <th>UNITS</th>
                <th>BILL DATE</th>
                <th>DUE DATE</th>
                <th>GENERATE</th>                                        
            </tr>
        </thead>
        <tbody>
            <?php 
            $query1 = "SELECT COUNT(*) FROM users";
            $result1 = mysqli_query($con,$query1);
            $row1 = mysqli_fetch_row($result1);
            $numrows = $row1[0];
            include("paging_1.php");                       
            $result = retrieve_bill_data($offset, $rowsperpage);

            while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <form action="generate_bill.php" method="post" name="form_gen_bill" onsubmit="return checkInp()">
                    <?php
                        $query3 = "SELECT billdate as bdate1 from bills ,users WHERE users.id=bills.userid and users.id={$row['userid']} ORDER BY bills.billid DESC ";
                        $result3 = mysqli_query($con,$query3);
                        $flag=0;
                        while($row2 = mysqli_fetch_assoc($result3)){
                            if($row2['bdate1']==$row['bdate']) $flag=1;
                        }
                        
                        if($flag==0)
                        {
                     ?>
                        <input type="hidden" name="uid" value=<?php echo $row['userid'] ?> >
                        <input type="hidden" name="uname" value=<?php echo $row['username'] ?> >
                        
                        <td height="50">
                            <?php echo $row['username'] ?>
                        </td>
                        <td>                                                
                            <input class="form-control" type="tel" name="units" placeholder="ENTER UNITS">
                        </td>
                        <td>
                            <?php echo $row['bdate'] ?> 
                        </td>
                        <td>
                            <?php echo $row['ddate'] ?>
                        </td>
                        <td>
                            <button type="submit" name="generate_bill" class="btn btn-success form-control">GENERATE BILL  </button>
                        </td>
                    <?php 
                        } 
                    ?>
                    </form>
                </tr>                
                <?php 
                    } 
                ?>
            </tbody>                
        </table>
        <?php include("paging_2.php");  ?>
    </div>  
<script>
    function checkInp()
    {
        var x=document.forms["form_gen_bill"]["units"].value;
        if (isNaN(x)) 
        {
            alert("Must input numbers");
            return false;
        }
    }
</script>