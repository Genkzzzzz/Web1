<?php
include('includes/dbconnect.php');

$sql = "select * from products";
$result = mysqli_query($conn, $sql);

if(isset($_POST['done_order'])){
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/orderstyle.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript">
    function getData(pid) {

        $.ajax({
            url: 'loadproduct.php?pid=' + pid,
            success: function(output) {
                if (output !== "") {
                    var my_arr = "";
                    my_arr = output.split("|");
                    document.querySelector("#price").value = my_arr[0];
                    document.querySelector("#productname").value = my_arr[1];

                } else {
                    document.querySelector("#price").value = "";
                    document.querySelector("#productname").value = "";

                }
            }
        });
    }

    function passData() {
        let product_table = document.querySelector(".product_table");
        let payment = document.querySelector("#payment").value;
        let total = document.querySelector("#total").value;
        let discount = document.querySelector("#discount").value;
        //
        let pid = document.querySelector("#productid").value;
        let quantity = parseInt(document.querySelector("#quantity").value);
        let sub = parseInt(document.querySelector("#subtotal").value);

        let mydata = 'pid=' + pid + '&pquantity=' + quantity + '&subtotal=' + sub + '&discount=' + discount +
            '&total=' + total
        $.ajax({
            type: "POST",
            url: 'addsale.php',
            data: mydata,
            success: function(html) {
                var ajaxDisplay = document.querySelector("#msg");
                ajaxDisplay.innerHTML = html;
            }
        });

        document.querySelector("#quantity").value = "";
        document.querySelector("#productid").value = "";
        document.querySelector("#productname").value = "";
        document.querySelector("#price").value = "";
        document.querySelector("#subtotal").value = "";
        //

       

        /*if(payment==="" || total===""){
            alert("No Payment Yet");
        }else{
            for(var i=0;i<product_table.rows.length;i++)
            {
                let pid = parseInt(product_table.rows[i].cells[0].innerHTML);
                let quantity = parseInt(product_table.rows[i].cells[1].innerHTML);
                let subtotal = parseInt(product_table.rows[i].cells[3].innerHTML);
                let mydata= 'pid='+pid+'&pquantity='+quantity+'&subtotal='+subtotal+'&discount='+discount+'&total='+total
                $.ajax({
                    type: "POST",
                    url: 'addsale.php',
                    data: mydata,
                    success: function(html) {
                        var ajaxDisplay = document.querySelector("#msg");
                        ajaxDisplay.innerHTML = html;
                    }
                });
                pid=0;
                quantity=0;
                subtotal=0;
                /*$.ajax({
                    cache: false,
                    url: 'addsale.php?pid='+pid+'&pquantity='+quantity+'&subtotal='+subtotal+'&discount='+discount+'&total='+total,
                    success: function(html) {
                        var ajaxDisplay = document.querySelector("#msg");
                        ajaxDisplay.innerHTML = html;
                    }
                });*/
        // }
        /*document.querySelector("#payment").value="";
        document.querySelector("#total").value="";
        document.querySelector("#change").value="";
        document.querySelector("#productname").value="";
        document.querySelector("#discount").value="";*/

        totalamount = 0;
        //product_table.innerHTML="";
        //}
    }

    function setproductid(val) {
        document.querySelector("#productid").value = val;
    }

    function setdiscount(val) {
        switch (val) {
            case 'sc':
                document.querySelector("#discount").value = "20%";
                break;
            case 'pwd':
                document.querySelector("#discount").value = "20%";
                break;
            case 'ed':
                document.querySelector("#discount").value = "100%";
                break;
            case 'nd':
                document.querySelector("#discount").value = "0%";
                break;
            default:
                break;
        }
    }
    let totalamount = 0;

    function setoverallTotal() {
        totalamount = 0;
        for (var i = 0; i < product_table.rows.length; i++) {
            let val = parseInt(product_table.rows[i].cells[3].innerHTML);
            totalamount = totalamount + val;
        }
        document.querySelector("#total").value = totalamount;
        val = 0;
    }

    function Discount() {
        let overalltotal = totalamount;
        let total = totalamount;
        let disc = 0;
        var discount = document.querySelector("#discount").value;
        switch (discount) {
            case '20%':
                disc = overalltotal * 0.20;
                total -= disc;
                break;
            case '20%':
                disc = overalltotal * 0.20;
                total -= disc;
                break;
            case '100%':
                disc = overalltotal * 1;
                total -= disc;
                break;
            case '0%':
                total = overalltotal;
                break;
            default:
                break;
        }
        document.querySelector("#total").value = total;
    }

    function solvePayment() {
        let payment = document.querySelector("#payment").value;
        let total = document.querySelector("#total").value;
        let change = document.querySelector("#change");

        let ch = payment - total;
        change.value = ch;
    }

    function solvetotal() {
        let product_price = document.querySelector("#price").value;
        let quantity = document.querySelector("#quantity").value;

        let subtotal = quantity * product_price;

        let subtotaldisplay = document.querySelector("#subtotal");
        subtotaldisplay.value = subtotal;
    }

    function deleteRow(o) {
        var p = o.parentNode.parentNode;
        p.parentNode.removeChild(p);
    }
    </script>
    <title>Order</title>
</head>

<body>
    <div class="container-fluid py-2 px-5 ">
        <img src="images/logo.png" alt="" class="img-fluid" style="width: 200px; margin: 2em;">
        <div class="d-flex justify-content-between my-4">
            <a href="Dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            <h3 class="msg"></h3>
            <h4>Items</h4>
        </div>

        <ul class="row" style="list-style:none; height: 500px; background-color:#efefef; overflow: auto;">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <li class="col-md-2 item_col" onclick="setproductid(<?php echo $row['Product_ID'] ?>);">
                <div class="item py-4 my-2" style="text-align: center;">
                    <img src="images/<?php echo $row['Product_Image'] ?>" alt="" style="width: 150px;">
                    <p style="margin: 0;"><?php echo $row['Product_Name'] ?></p>
                    <p style="margin: 0; color: red;" class="item_price"><?php echo $row['Price'] ?></p>
                    <p style="margin: 0; color: green;">Size:<?php echo $row['Cup'] ?></p>
                    <div class="item_btns" style="text-align: center;">
                        <button class="btn btn-outline-primary"
                            onclick="getData(<?php echo $row['Product_ID'] ?>); ">Add</button>
                    </div>
                </div>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <?php
    include('includes/dbclose.php');
    ?>
    <div class="container-fluid">
        <form method="post" class="px-5 py-3" id="orderform">
            <div class="d-flex justify-content-between">
                <h4>Order</h4>
            </div>
            <div class="form-group row">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="productid" class="form-label">Product ID:</label>
                        <input type="number" class="form-control input_fields" id="productid" placeholder="Product ID"
                            name="productid" oninput="solvetotal();" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="productname" class="form-label">Product Name:</label>
                        <input type="text" class="form-control input_fields" id="productname" placeholder="Product Name"
                            name="productname" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="number" class="form-control input_fields" id="price" placeholder="Price"
                            name="price" readonly>
                    </div>
                    <div class="mb-3 col-md-3">
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control input_fields" id="quantity" placeholder="Quantity"
                            name="quantity" autocomplete="off"
                            oninput="solvetotal();this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="subtotal" class="form-label">SubTotal:</label>
                        <input type="number" class="form-control input_fields" id="subtotal" placeholder="SubTotal"
                            name="subtotal" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <button type="button" class="btn btn-primary add" name="order_product"
                            onclick="setTable(); passData();  setoverallTotal();">Place Order</button>
                    </div>
                </div>
            </div>
            <div class="form-group table_holder mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody class="product_table" id="order_table">
                    </tbody>
                </table>
            </div>
            <div class="form-group row">
                <div class="col-md-6 py-3">
                    <div class="mb-3 col-md">
                        <label for="discount" class="form-label">Discount:</label>
                        <div class="mb-3 col-md">
                            <button type="button" class="btn btn-primary add my-2" name="discount1"
                                onclick="setdiscount('sc'); Discount();">Senior Citizen</button>
                            <button type="button" class="btn btn-primary add my-2" name="discount2"
                                onclick="setdiscount('pwd'); Discount();">PWD Discount</button>
                            <button type="button" class="btn btn-primary add my-2" name="discount3"
                                onclick="setdiscount('ed'); Discount();">Employee Discount</button>
                            <button type="button" class="btn btn-primary add my-2" name="discount4"
                                onclick="setdiscount('nd'); Discount();">No Discount</button>
                        </div>
                        <input type="text" class="form-control input_fields" id="discount" placeholder="Discount"
                            name="discount" readonly>
                    </div>
                </div>

                <div class="col-md-6 py-3">
                    <div class="mb-3 col-sm">
                        <label for="total" class="form-label">Total:</label>
                        <input type="text" class="form-control input_fields" id="total" placeholder="Total" name="total"
                            readonly>
                    </div>
                    <div class="mb-3 col-sm">
                        <label for="payment" class="form-label">Payment:</label>
                        <input type="number" class="form-control input_fields" id="payment" placeholder="Payment"
                            name="payment" oninput="solvePayment();">
                    </div>
                    <div class="mb-3 col-sm">
                        <label for="change" class="form-label">Change:</label>
                        <input type="text" class="form-control input_fields" id="change" placeholder="Change"
                            name="change" readonly>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <button type="button" class="btn btn-primary add" name="done_order"
                                onclick="rel();passData()">Done</button>
                        </div>
                        <div class="col-sm">
                            <h6 id="msg"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
    let product_table = document.querySelector(".product_table");

    function setTable() {
        var index = 0;

        let productid = document.querySelector("#productid").value;
        let product_price = document.querySelector("#price").value;
        let quantity = document.querySelector("#quantity").value;
        let subtotal = document.querySelector("#subtotal").value;

        if (quantity == 0) {
            alert("You need to input the quantity of the product. Please Try Again");
        } else {
            var row = product_table.insertRow(index);
            var pidcell = row.insertCell(0);
            var pquantitycell = row.insertCell(1);
            var ppricecell = row.insertCell(2);
            var psubtotalcell = row.insertCell(3);

            pidcell.innerHTML = productid;
            ppricecell.innerHTML = product_price;
            pquantitycell.innerHTML = quantity;
            psubtotalcell.innerHTML = subtotal;

            index++;
        }



    }

    function rel() {
        location.reload();
    }
    </script>
    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>