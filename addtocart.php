<?php
    $productid=$_GET['pid'];
    if($pID == "")
    {
        header('location:itemlist.php');
    }
    if(isset($_POST['get_item'])){
        include('includes/dbconnect.php');
        $sql="insert into customer_cart(Customer_ID,Product_Name) values('10','$productid')";
        mysqli_query($conn,$sql);
        include('includes/dbclose.php');
    }
?>