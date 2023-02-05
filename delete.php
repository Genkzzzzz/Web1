<?php
    $id=$_GET['id'];
    $status=$_GET['status'];
    include('includes/dbconnect.php');
    switch($status){
        case 'product':
            $sql="delete from products where Product_ID='$id'";
            $result=mysqli_query($conn,$sql);
            include('includes/dbclose.php');
            header('location:addproduct.php');
            break;
        case 'employee':
            $sql="delete from employees where Employee_ID='$id'";
            mysqli_query($conn,$sql);

            include('includes/dbclose.php');
            header('location:employeemanager.php');
            break;
    }
?>