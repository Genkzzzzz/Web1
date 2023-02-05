<?php
include('includes/dbconnect.php');
    $productname= $_GET['productname'];
    $code= $_GET['code'];
    $beggining= $_GET['beggining'];
    $deladd= $_GET['deladd'];
    $pullout= $_GET['pullout'];
    $usage= $_GET['usage'];
    $endingbal= $_GET['endingbal'];
    $grandtotal= $_GET['grandtotal'];
    $headoffice= $_GET['headoffice'];
    $branch= $_GET['branch'];
    $sales= $_GET['sales'];
    $expenses= $_GET['expenses'];
    $expensales= $_GET['expensales'];

    $datenow=date('Y-m-d 00:00:00');
    $usage=0;
    $endingbal=0;
    $grandtotal=0;
            
        $query="select * from inventory where Item_Code='$code' and Date='$datenow'";
        $res=mysqli_query($conn,$query);
        //$row=mysqli_fetch_assoc($res);
        if (mysqli_num_rows($res)>0)
        {
            $row=mysqli_fetch_assoc($res);
            $retrieveddelivery=$row['Del_Add'];
            $beginningbal=$row['Beg_Balance'];
            $endingbal=$row['Ending_Balance'];
            $pull=$row['Pull_Out'];
            $newdeladd=$deladd+$retrieveddelivery;

            $newpullout=$pull+$pullout;
            $newendingbal=$endingbal+$deladd;
            $newendingbal=$newendingbal+$newdeladd-$pullout;

            $sqlupdate="update inventory set Del_Add='$newdeladd',Pull_Out='$newpullout',Ending_Balance='$newendingbal' where Item_Code='$code' and Date='$datenow'";
            mysqli_query($conn,$sqlupdate);
        }else{
            $sql="insert into inventory(Product,Item_Code,Beg_Balance,Del_Add,Pull_Out,Usage_Sales,Ending_Balance,Grand_Total,Head_Office,Branch,Date)
            values('$productname','$code','$beggining','$deladd','$pullout','$usage','$endingbal','$grandtotal','$headoffice','$branch','$datenow')";
            if (!mysqli_query($conn,$sql)) {
                echo("Error description: " . mysqli_error($conn));
            }
        }
    include('includes/dbclose.php');

    header('location:ingredients.php');
?>
