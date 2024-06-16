<?php 
    function retrieve_generated_bills($id,$offset, $rowsperpage) {
        global $con;
        $query  = "SELECT users.name AS users, bills.billdate AS billdate , bills.units AS units , bills.amount AS amount , bills.billid as bid , bills.duedate AS duedate, bills.status AS billstatus";
        $query .= " FROM users , bills ";
        $query .= " WHERE users.id=bills.userid AND adminid={$id} ";
        $query .= " ORDER BY bills.billid DESC ";
        $query .= " LIMIT {$offset}, {$rowsperpage} ";

        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysqli_error()); 
        }
        return $result;
    }

    function retrieve_bill_data($offset, $rowsperpage){
        global $con;
        $query  = "SELECT curdate() AS bdate , adddate( curdate(),INTERVAL 30 DAY ) AS ddate , users.id AS userid , users.name AS username FROM users ";
        $query .= " LIMIT {$offset}, {$rowsperpage} ";
        
        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysqli_error()); 
        }
        return $result;
    }  
    function retrieve_complaints_history($id,$offset,$rowsperpage)
    {
        global $con;
        $query  = "SELECT complaint.id AS id , complaint.complaint AS complaint , complaint.status AS status , users.name AS uname ";
        $query .= "FROM users , complaint ";
        $query .= "WHERE complaint.userid=users.id AND status='NOT PROCESSED' AND complaint.adminid={$id} ";
        $query .= "ORDER BY complaint.id desc  ";
        $query .= "LIMIT {$offset}, {$rowsperpage} ";

        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysqli_error()); 
        }

        return $result;

    }
    function retrieve_users_details($id,$offset, $rowsperpage)
    {
        global $con;
        $query  = "SELECT * FROM users ";
        $query .= " LIMIT {$offset}, {$rowsperpage} ";
        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysqli_error()); 
        }
        return $result;
    }

    function retrieve_admin_stats($id)
    {
        global $con;
        $query1  = " SELECT count(billid) AS unprocessed_bills FROM bills  WHERE status = 'PENDING'  AND adminid = {$id} ";
        $query2  = " SELECT count(billid) AS generated_bills FROM bills  WHERE adminid = {$id} " ;
        $query3  = " SELECT count(id) AS unprocessed_complaints FROM complaint where status='NOT PROCESSED' AND adminid={$id}";
       
        
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

    function retrieve_users_defaults($id){
        global $con;
        $query1="SELECT retrieve_lateusers({$id}) FROM DUAL";
        $result1=mysqli_query($con,$query1);
        $query2="SELECT remove_users({$id}) FROM DUAL";
        $result2=mysqli_query($con,$query2);
        return array($result1,$result2,);
    }

    function insert_into_transaction($id,$amount){
            global $con;
            $query = "INSERT INTO transaction (billid,amount,paymentdate,status) ";
            $query .= "VALUES ({$id}, {$amount} , NULL , 'PENDING' )";
   
            if (!mysqli_query($con,$query))
            {
                die('Error: ' . mysqli_error($con));
            }

        }
        function retrieve_lineman_information($id,$offset, $rowsperpage){
            global $con;
            $query  = "SELECT lineman.lid AS id , lineman.name AS name, lineman.phone AS phone, lineman.locid AS pincode ";
            $query .= "FROM lineman ";
            $query .= "ORDER BY lineman.lid "; 
            $query .= "LIMIT {$offset}, {$rowsperpage} ";
            $result = mysqli_query($con,$query);
            if (!$result)   
            {
                die('Error: ' . mysqli_error($con));
            }  
            return $result;
        }
        function retrieve_powercut_information($id,$offset, $rowsperpage){
            global $con;
            $query  = "SELECT powercut.pid AS id , powercut.cause AS cause, powercut.time1 AS time1,powercut.time2 AS time2, powercut.date AS date,powercut.locid AS pincode ";
            $query .= "FROM powercut ";
            $query .= "ORDER BY powercut.pid "; 
            $query .= "LIMIT {$offset}, {$rowsperpage} ";
            $result = mysqli_query($con,$query);
            if (!$result)   
            {
                die('Error: ' . mysqli_error($con));
            }  
            return $result;
        }

 ?>