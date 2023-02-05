<?php
    $retrievedpid = $_GET['pid'];  
    
    include('includes/dbconnect.php');
    $pid=mysqli_real_escape_string($conn,$retrievedpid);  
        $sql="select * from products where Product_ID='$pid'";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result))
        {
            echo $row['Price']."|".$row['Product_Name'];
        }
    include('includes/dbclose.php');
?>
