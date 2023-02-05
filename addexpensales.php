<?php
include('includes/dbconnect.php');
    
    $sales= $_GET['sales'];
    $expenses= $_GET['expenses'];
    $expensales= $_GET['expensales'];
    $datenow=date("Y-m-d");
    
    $sql="insert into grandtotal(Total_Sales,Total_Expenses,Grand_Total,Date)
    values('$sales','$expenses','$expensales','$datenow')";
    if (!mysqli_query($conn,$sql)) {
        echo("Error description: " . mysqli_error($conn));
    }
    include('includes/dbclose.php');

    header('location:ingredients.php');
?>