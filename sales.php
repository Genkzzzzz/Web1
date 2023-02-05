<?php
  include('includes/dbconnect.php');
  $date=date("Y-m-d 00:00:00");
  $sql="SELECT * from inventory where Date='$date'";

 /*if(isset($_POST['search']))
  {
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    if($search=="")
    {
      $sql="SELECT Sales.Sales_ID,Sales.Date,Products.Product_ID,Products.Product_Name,Products.Price,Sales.Quantity,Sales.Sub_Total,Sales.Discounted_Amount
      FROM Sales
      INNER JOIN Products
      ON Sales.Product_ID=products.Product_ID;";
    }else
    {
      $sql="SELECT Sales.Sales_ID,Sales.Date,Products.Product_ID,Products.Product_Name,Products.Price,Sales.Quantity,Sales.Sub_Total,Sales.Discounted_Amount
      FROM Sales
      INNER JOIN Products
      ON Sales.Product_ID=products.Product_ID where Products.Product_ID='$search' and Sales.Product_ID='$search';";
    }
  }*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/salesstyle.css">
    <title>Sales</title>
</head>
<body>
    <div class="container">
        <form action="#" method="post" class="px-5 py-4 mt-4" id="productadd" >
        <img src="images/logo.png" alt="" class="img-fluid" style="width: 200px; margin: 2em;">
            <div class="d-flex justify-content-between m-1">
              <a href="Dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
              <h4>Sales</h4>
            </div>
            <!--<div class="form-group">
                <div class="input-group">
                    <input type="search" class="form-control rounded" placeholder="Search Product ID" aria-label="Search"
                    aria-describedby="search-addon" name="search"  autocomplete="off"/>
                    <button type="submit" class="btn btn-outline-primary" name="search_product">search</button>
                  </div>
            </div>-->
            <div class="form-group table_holder mt-3">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Code</th>
                        <th>Grand Total</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody  class="product_table">
                      <?php
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                      ?>
                      <tr>
                        <td><?php echo $row['Product'];?></td>
                        <td><?php echo $row['Item_Code'];?></td>
                        <td><?php echo $row['Grand_Total'];?></td>
                        <td><?php echo $row['Date'];?></td>
                      </tr>
                      <?php
                        }
                        include('includes/dbclose.php');
                      ?>
                    </tbody>
                  </table>
            </div>
            <div class="form-group row mx-3 my-5">
                <div class="mb-3 col-sm">
                    <label for="totalsales" class="form-label">Total Sales:</label>
                    <input type="number" class="form-control input_fields" id="totalsales" placeholder="Total Sales" name="totalsales" readonly>
                </div>
                <div class="mb-3 col-sm">
                    <label for="totalexpenses" class="form-label">Total Expenses:</label>
                    <input type="number" class="form-control input_fields" id="totalexpenses" placeholder="Total Expenses" name="totalexpenses" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <br>
                    <button type="button" class="btn btn-primary add" name="submit_inventory" onclick="solvegrandtotal();">Enter</button>
                </div>
                <div class="mb-3 col-sm">
                    <label for="expensales" class="form-label">Grand Total:</label>
                    <input type="number" class="form-control input_fields" id="expensales" placeholder="Grand Total" name="expensales" readonly>
                </div>
            </div>
          </form>
    </div>
    <script>
     window.onload=getsales();
      function getsales(){
        let product_table=document.querySelector(".product_table");
        let sales=0;
        for(var i=0;i<product_table.rows.length;i++)
        {
          let pid = parseInt(product_table.rows[i].cells[2].innerHTML);
          sales+=pid;
        }       
        document.querySelector("#totalsales").value=sales;    
      }
      function solvegrandtotal(){
            let sales=document.querySelector("#totalsales").value;
            let expenses= document.querySelector("#totalexpenses").value;
            let total=0;
            total =parseInt(sales)-parseInt(expenses);
            document.querySelector("#expensales").value=total;
            $.ajax({
                url: 'addexpensales.php?sales='+sales+'&expenses='+expenses+'&expensales='+total,
                success: function(html) {
                }
            }); 
        }
    </script>
    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>