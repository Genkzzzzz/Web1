<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        function getbeginningbalance() {
            let pname = document.querySelector("#productname").value;
            let code = document.querySelector("#code").value;
            $.ajax({
                url: 'loadbeginningbal.php?pname=' + pname + '&code=' + code,
                success: function(output) {
                    if (output !== "") {
                        document.querySelector("#beggining").value = output;
                        
                    } else {
                        document.querySelector("#beggining").value = 0;
                    }
                }
            });
        }
    </script>
    <title>Ingredients Inventory</title>
</head>

<body>
    <div class="container-fluid">
        <form action="" method="post">
            <img src="images/logo.png" alt="" class="img-fluid" style="width: 200px; margin: 2em;">
            <div class="d-flex justify-content-between px-4">
                <a href="Dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
                <h3 class="msg"></h3>
                <h4>Inventory Form</h4>
            </div>
            <div class="row mx-3 py-3">
                <div class="mb-3 col-md-3">
                    <label for="branch" class="form-label">Branch:</label>
                    <input type="text" class="form-control input_fields" id="branch" placeholder="Branch" name="branch" value="SM Dasmarinas" readonly>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="headoffice" class="form-label">Head Office:</label>
                    <input type="text" class="form-control input_fields" id="headoffice" placeholder="Head Office" name="headoffice" autocomplete="off" value="QC" readonly>
                </div>
            </div>
            <div class="form-group row mx-3">
                <div class="mb-3 col-md-3">
                    <label for="productname" class="form-label">Product Name:</label>
                    <input type="text" class="form-control input_fields" id="productname" placeholder="Product Name" name="productname" autocomplete="off" oninput="getbeginningbalance()">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="code" class="form-label">Code:</label>
                    <input type="text" class="form-control input_fields" id="code" placeholder="Code" name="code">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="beggining" class="form-label">Beggining Balance:</label>
                    <input type="number" class="form-control input_fields" id="beggining" placeholder="Beggining Balance" name="beggining" readonly>
                </div>
                <div class="mb-3 col-md-3">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="deladd" class="form-label">Delivery (Add)</label>
                    <input type="number" class="form-control input_fields" id="deladd" placeholder="Delivery (Add)" name="deladd" autocomplete="off">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="pullout" class="form-label">Pull Out:</label>
                    <input type="number" class="form-control input_fields" id="pullout" placeholder="Pull Out" name="pullout" autocomplete="off">
                </div>
                <div class="mb-3 col-md-3">
                    <label for="grandtotal" class="form-label" hidden>Grand Total:</label>
                    <input type="number" class="form-control input_fields" id="grandtotal" placeholder="Grand Total" name="grandtotal" value="0" hidden>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="usage" class="form-label" hidden>Usage:</label>
                    <input type="text" class="form-control input_fields" id="usage" placeholder="Usage" name="usage" value="0" autocomplete="off" hidden>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="endingbal" class="form-label" hidden>Ending Balance:</label>
                    <input type="number" class="form-control input_fields" id="endingbal" placeholder="Ending Balance" name="endingbal" value="0" hidden>
                </div>
            </div>

            <div class="row m-3">
                <div class="col-sm">
                    <button type="button" class="btn btn-primary add" name="submit_inventory" onclick="passData();">Submit Form</button>
                </div>
            </div>
            <div class="form-group table_holder mt-3 mb-3">
                <?php
                include('includes/dbconnect.php');
                $date = date("Y-m-d");
                $sql = "SELECT * from inventory WHERE date = '$date' ";

                ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Beggining Balance</th>
                            <th>Delivery</th>
                            <th>Pull Out</th>
                            <th>Usage Sales</th>
                            <th>Ending Balance</th>

                        </tr>
                    </thead>
                    <tbody class="product_table">
                        <?php
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['Product']; ?></td>
                                <td><?php echo $row['Item_Code']; ?></td>
                                <td><?php echo $row['Beg_Balance']; ?></td>
                                <td><?php echo $row['Del_Add']; ?></td>
                                <td><?php echo $row['Pull_Out']; ?></td>
                                <td><?php echo $row['Usage_Sales']; ?></td>
                                <td><?php echo $row['Ending_Balance']; ?></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
        <?php
        include('includes/dbclose.php');
        ?>
    </div>
    <script>
        function passData() {
            let branch = document.querySelector("#branch").value;
            let productname = document.querySelector("#productname").value;
            let code = document.querySelector("#code").value;
            let beggining = parseInt(document.querySelector("#beggining").value);
            let deladd = parseInt(document.querySelector("#deladd").value);
            let pullout = parseInt(document.querySelector("#pullout").value);
            let usage = 0;
            let endingbal = 0;
            let grandtotal = 0;
            let headoffice = document.querySelector("#headoffice").value;
            $.ajax({
                url: 'addinventory.php?productname=' + productname + '&code=' + code + '&beggining=' + beggining + '&deladd=' + deladd + '&pullout=' + pullout + '&usage=' + usage + '&endingbal=' + endingbal + '&grandtotal=' + grandtotal + '&headoffice=' + headoffice + '&branch=' + branch,
                success: function(html) {
                    location.reload();
                }
            });

            document.querySelector("#productname").value = "";
            document.querySelector("#code").value = "";
            document.querySelector("#beggining").value = "";
            document.querySelector("#deladd").value = "";
            document.querySelector("#pullout").value = "";
        }
    </script>
    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>