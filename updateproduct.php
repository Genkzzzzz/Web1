<?php
    $pID = $_GET['pid'];
    if($pID == "")
    {
        header('location:addproduct.php');
    }

    include('includes/dbconnect.php');
    $sql = "SELECT * FROM products WHERE Product_ID = '$pID'";
    $updateResult = mysqli_query($conn, $sql) or die('Query Error');

  if(isset($_POST['update_product']))
  {
    include('includes/dbconnect.php');

    $productname=mysqli_real_escape_string($conn,$_POST['productname']);
    $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);
    $price=mysqli_real_escape_string($conn,$_POST['price']);
    $description=mysqli_real_escape_string($conn,$_POST['description']);

    $sql="update products set Product_Name='$productname',Quantity='$quantity',Price='$price',Description='$description' where Product_ID='$pID' ";

    $result=mysqli_query($conn,$sql);

    include('includes/dbclose.php');
    echo "<script>";
    echo "window.location.href ='addproduct.php';";
    echo "</script>";
  }
  if(isset($_POST['cancel_product']))
  {
    echo "<script>";
    echo "window.location.href ='addproduct.php';";
    echo "</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Products</title>
</head>
<body>
    <div class="container">
        <?php
            while($updateRow = mysqli_fetch_assoc($updateResult))
            {
        ?>
        <form action="" method="post" class="p-5 mt-5">
            <h4>Products</h4>
            <div class="form-group row">
                <div class="mb-3 col-sm">
                    <label for="productname" class="form-label">Product Name:</label>
                    <input type="text" class="form-control input_fields" id="productname" placeholder="Product Name" name="productname" value="<?php echo $updateRow['Product_Name'];?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="text" class="form-control input_fields" id="quantity" placeholder="Quantity" name="quantity" value="<?php echo $updateRow['Quantity'];?>">
                </div>
                 <div class="mb-3 col-sm">
                    <label for="price" class="form-label">Price:</label>
                    <input type="text" class="form-control input_fields" id="price" placeholder="Price" name="price" value="<?php echo $updateRow['Price'];?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" class="form-control input_fields" id="description" placeholder="Description" name="description" value="<?php echo $updateRow['Description'];?>">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary add" name="update_product">Update</button>
            <button type="submit" class="btn btn-primary add" name="cancel_product">Cancel</button>
          </form>
        <?php
            }
        ?>
    </div>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    include('includes/dbclose.php');
?>