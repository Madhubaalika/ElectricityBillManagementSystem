<?php 
    // require_once("config.php");
    
    function retrieve_user_complaints($id,$offset, $rowsperpage) {
        global $con;
        $query = "SELECT * FROM complaint where userid={$id} ";
        $query .= "ORDER BY id DESC ";
        $query .= "LIMIT {$offset}, {$rowsperpage}";
        $result1 = mysqli_query($con,$query);
        return $result1;
    }

    function retrieve_bills_history($id,$offset, $rowsperpage) {
        global $con;
        $query = "SELECT * FROM bills where userid={$id} ";
        $query .= "ORDER BY billdate DESC ";
        $query .= "LIMIT {$offset}, {$rowsperpage} ";
        $result = mysqli_query($con,$query);
        return $result;
    }

    function retrieve_bills_due($id,$offset, $rowsperpage) {
        global $con;
        $query  = "SELECT bills.billdate AS billdate, bills.units AS units, bills.duedate AS duedate, transaction.amount AS payable, ";
        $query .= " bills.amount AS amount ,transaction.amount-bills.amount AS dues , bills.billid AS id ";
        $query .= "FROM bills , transaction ";
        $query .= "WHERE transaction.billid=bills.billid AND bills.userid={$id} AND bills.status='PENDING' ";
        $query .= "ORDER BY bills.duedate desc "; 
        $query .= "LIMIT {$offset}, {$rowsperpage} ";
        $result = mysqli_query($con,$query);
        return $result;
    }
    function retrieve_transaction_history($id,$offset, $rowsperpage) {
        global $con;
        $query  = "SELECT transaction.id AS id , bills.billdate AS billdate, transaction.paymentdate AS paydate, transaction.amount AS payable, ";
        $query .= " bills.amount AS amount ,transaction.amount-bills.amount AS dues ";
        $query .= "FROM bills , transaction ";
        $query .= "WHERE transaction.billid=bills.billid AND bills.userid={$id} ";
        $query .= "ORDER BY bills.duedate desc "; 
        $query .= "LIMIT {$offset}, {$rowsperpage} ";
        $result = mysqli_query($con,$query);
        return $result;
    }
    function retrieve_lineman_info($id,$offset, $rowsperpage){
        global $con;
        $query  = "SELECT lineman.lid AS id , lineman.name AS name, lineman.phone AS phone, lineman.locid AS pincode ";
        $query .= "FROM users , location, lineman ";
        $query .= "WHERE users.pincode=location.id AND users.id={$id} AND location.id=lineman.locid ";
        $query .= "ORDER BY lineman.lid "; 
        $query .= "LIMIT {$offset}, {$rowsperpage} ";
        $result = mysqli_query($con,$query);
        if (!$result)   
        {
            die('Error: ' . mysqli_error($con));
        }  
        return $result;
    }
    function retrieve_powercut_info($id,$offset, $rowsperpage){
        global $con;
        $query  = "SELECT powercut.pid AS id , powercut.cause AS cause, powercut.time1 AS time1,powercut.time2 AS time2, powercut.date AS date,powercut.locid AS pincode ";
        $query .= "FROM users , location, powercut ";
        $query .= "WHERE users.pincode=location.id AND users.id={$id} AND location.id=powercut.locid ";
        $query .= "ORDER BY powercut.pid "; 
        $query .= "LIMIT {$offset}, {$rowsperpage} ";
        $result = mysqli_query($con,$query);
        if (!$result)   
        {
            die('Error: ' . mysqli_error($con));
        }  
        return $result;
    }

    function retrieve_user_details($id) {
        global $con;
        $query  = "SELECT * FROM users ";
        $result = mysqli_query($con, $query);

        if (!$result)   
            {
                die('Error: ' . mysqli_error($con));
            }  
        return $result;
    }

    function retrieve_user_stats($id)
    {
        global $con;
        $query1  = " SELECT count(billid) AS unprocessed_bills FROM bills  WHERE status = 'PENDING'  AND userid = {$id} ";
        $query2  = " SELECT count(billid) AS payed_bills FROM bills  WHERE userid = {$id} AND status='PROCESSED'" ;
        $query3  = " SELECT count(id) AS unprocessed_complaints from complaint where status='NOT PROCESSED' AND userid = {$id} ";

        
        $result1 = mysqli_query($con,$query1);
        if($result1 === FALSE) {
            echo "FAILED1";
            die(mysqli_error()); 
        }

        $result2 = mysqli_query($con,$query2);
        if($result2 === FALSE) {
            echo "FAILED2";
            die(mysqli_error()); 
        }

        $result3 = mysqli_query($con,$query3);
        if($result3 === FALSE) {
            echo "FAILED3";
            die(mysqli_error()); 
        }

        return array($result1,$result2,$result3);
    }

 ?>