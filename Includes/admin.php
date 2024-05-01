<?php 
    // require_once("config.php");

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
        $query  = "SELECT complaint.id AS id , complaint.complaint AS complaint , complaint.status AS compstatus , users.name AS uname ";
        $query .= "FROM users , complaint ";
        $query .= "WHERE complaint.userid=users.id AND compstatus='NOT PROCESSED' ";
        $query .= "ORDER BY complaint.id desc  ";
        $query .= "LIMIT {$offset}, {$rowsperpage} ";

        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysqli_error()); 
        }

        return $result;

    }

    function retrieve_users_detail($id,$offset, $rowsperpage)
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
        $query3  = " SELECT count(id) AS unprocessed_complaints FROM complaint where status='NOT PROCESSED' ";
       
        
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

        $query1  = "SELECT COUNT(*) FROM bills , transaction ";
        $query1 .= "WHERE curdate() > bills.duedate AND curdate() < adddate(bills.duedate , INTERVAL 25 DAY ) ";
        $query1 .= "AND bills.adminid={$id} AND bills.status='PENDING' ";
        $query1 .= "AND bills.amount = transaction.amount AND bills.billid=transaction.billid ";

        $query2  = "SELECT COUNT(*) FROM bills  ";
        $query2 .= "WHERE curdate() > adddate(bills.duedate , INTERVAL 25 DAY ) ";
        $query2 .= "AND bills.adminid={$id} AND bills.status='PENDING' ";


        $result1 = mysqli_query($con,$query1);
        if (!$result1)
            {
                die('1Error: ' . mysqli_error($con));
            }

        $result2 = mysqli_query($con,$query2);
        if (!$result2)
            {
                die('2Error: ' . mysqli_error($con));
            }
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

 ?>