<?php
    $retrieved= $_GET['pname'];  
    include('includes/dbconnect.php');
    $date=date('Y-m-d');
    $beg=0;
    $code= $_GET['code'];
        $sql="select * from inventory where Product='$retrieved' AND date = '$date' ";
        $result=mysqli_query($conn,$sql);
        
        while($row=mysqli_fetch_assoc($result)){
            echo $row['Beg_Balance'];
            // if($row['Ending_Balance']!=0){
            //     echo $row['Ending_Balance'];
            // }else if($row['Ending_Balance']==0){
            //     echo $row['Beg_Balance']+$row['Del_Add'];
            // }else{
                // echo $beg;
            // }
        }
    include('includes/dbclose.php');
?>