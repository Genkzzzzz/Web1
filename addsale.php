<?php
include('includes/dbconnect.php');
    $retrievedpid = $_POST['pid'];  
    $purchasedquantity = $_POST['pquantity'];  
    $retrievedpsubtotal = $_POST['subtotal'];  
    $total = $_POST['total'];  //discounted total
    $discount = $_POST['discount']; 
    $date=date("Y-m-d 00:00:00");
    $ingredients1="";
    $ingredients2="";
    $ingredients3="";
    $ingredients4="";
    $ingredients5="";
    $cups="";
    $sql="select * from products where Product_ID='$retrievedpid'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
        $ingredients1=$row['Ingredients1'];
        $ingredients2=$row['Ingredients2'];
        $ingredients3=$row['Ingredients3'];
        $ingredients4=$row['Ingredients4'];
        $ingredients5=$row['Ingredients5'];
        $cups=$row['Cup'];
    }
    $codes = array($ingredients1,  $ingredients2, $ingredients3,$ingredients4,$ingredients5,$cups);
    $usage=0;
    include('includes/dbclose.php');

    include('includes/dbconnect.php');
    for ($x = 0; $x <6; $x++) {
        if($cups=="T"){
            $usage=1*$purchasedquantity;
        }else if($cups=="G"){
            $usage=1.5*$purchasedquantity;
        }else if($cups=="V"){
            $usage=2*$purchasedquantity;
        }
        $query="select * from inventory where Item_Code='$codes[$x]' and Date='$date'";
        $res=mysqli_query($conn,$query);
        $val=0;
        $beginningbal=0;
        $delivery=0;
        $retreivedgtotal=0;
        $grand=0;
        if($row=mysqli_fetch_assoc($res))
        {
            $val=$row['Usage_Sales'];
            $beginningbal=$row['Beg_Balance'];
            $delivery=$row['Del_Add'];
            $retreivedgtotal=$row['Grand_Total'];
        }
        if($x==5){
            $usage=1*$purchasedquantity;
            $grand=$retreivedgtotal+$retrievedpsubtotal;
        }
        $newamount=$val+$usage;
        $endingbal=$beginningbal+$delivery;
        $endingbal=$endingbal-$newamount;
        $sqlupdate="update inventory set Usage_Sales='$newamount',Ending_Balance='$endingbal',Grand_Total='$grand' where Item_Code='$codes[$x]' and Date='$date'";
        mysqli_query($conn,$sqlupdate);
        $val=0;
        $beginningbal=0;
        $delivery=0;
        $retreivedgtotal=0;
        $grand=0;
        $newamount=0;
    }

    include('includes/dbclose.php');
    
?>