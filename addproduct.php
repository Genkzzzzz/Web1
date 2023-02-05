<?php
ini_set('max_exection_time', 60);
if (isset($_POST['add_product'])) {
    include('includes/dbconnect.php');

    $productname = mysqli_real_escape_string($conn, $_POST['productname']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $ingredients1 = mysqli_real_escape_string($conn, $_POST['ingredients1']);
    $ingredients2 = mysqli_real_escape_string($conn, $_POST['ingredients2']);
    $ingredients3 = mysqli_real_escape_string($conn, $_POST['ingredients3']);
    $ingredients4 = mysqli_real_escape_string($conn, $_POST['ingredients4']);
    $ingredients5 = mysqli_real_escape_string($conn, $_POST['ingredients5']);
    $ingredients6 = mysqli_real_escape_string($conn, $_POST['ingredients6']);
    $cup = mysqli_real_escape_string($conn, $_POST['cuptype']);


    $sql = "SELECT * FROM products WHERE Product_Name='$productname' AND cup = '$cup' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Error
        echo "<script>alert('Product Name Already Exist!');</script>";
    } else {

        $name = $_FILES['image']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg", "jpeg", "png", "gif");
        // Check extension

        if (in_array($imageFileType, $extensions_arr)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $name)) {


                $sql = "insert into products(Product_Name,Price,Description,Product_Image,Ingredients1,Ingredients2,Ingredients3,Ingredients4,Ingredients5,Cup)
          values('$productname','$price','$description','$name','$ingredients1','$ingredients2','$ingredients3','$ingredients4','$ingredients5','$ingredients6'$cup')";
                $result = mysqli_query($conn, $sql);
            }
        }

        include('includes/dbclose.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/productstyle.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Products</title>
</head>

<body>
    <div class="container">
        <form action="#" method="post" class="px-5 py-4 mt-4" id="productadd" enctype='multipart/form-data'>
            <img src="images/logo.png" alt="" class="img-fluid" style="width: 200px; margin: 2em;">
            <div class="d-flex justify-content-between">
                <a href="Dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
                <h3 class="msg"></h3>
                <h4>Products</h4>
            </div>
            <div class="form-group row">
                <div class="mb-3 col-sm">
                    <label for="productname" class="form-label">Product Name:</label>
                    <input type="text" class="form-control input_fields" id="productname" placeholder="Product Name"
                        name="productname" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control input_fields" id="price" placeholder="Price" name="price"
                        autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" class="form-control input_fields" id="description" placeholder="Description"
                        name="description" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="cuptype" class="form-label">Type of Cup:</label>
                    <input type="text" class="form-control input_fields" id="cuptype" placeholder="T/G/V/HC/FL/DL"
                        name="cuptype" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="ingredients1" class="form-label">Ingredients 1(Code):</label>
                    <input type="text" class="form-control input_fields" id="ingredients1" placeholder="Ingredients 1"
                        name="ingredients1" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="ingredients2" class="form-label">Ingredients 2(Code):</label>
                    <input type="text" class="form-control input_fields" id="ingredients2" placeholder="Ingredients 2"
                        name="ingredients2" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="ingredients3" class="form-label">Ingredients 3(Code):</label>
                    <input type="text" class="form-control input_fields" id="ingredients3" placeholder="Ingredients 3"
                        name="ingredients3" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="ingredients4" class="form-label">Ingredients 4(Code):</label>
                    <input type="text" class="form-control input_fields" id="ingredients4" placeholder="Ingredients 4"
                        name="ingredients4" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="ingredients5" class="form-label">Ingredients 5(Code):</label>
                    <input type="text" class="form-control input_fields" id="ingredients5" placeholder="Ingredients 5"
                        name="ingredients5" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="ingredients6" class="form-label">Ingredients 6(Code):</label>
                    <input type="text" class="form-control input_fields" id="ingredients6" placeholder="Ingredients 6"
                        name="ingredients6" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label class="form-label" for="customFile">Upload Image:</label>
                    <input type="file" class="form-control" id="customFile" name="image" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary add" name="add_product">Add</button>
            <div class="form-group mt-4">
                <div class="input-group">
                    <input type="search" class="form-control rounded" placeholder="Search Product ID/Product Name"
                        aria-label="Search" aria-describedby="search-addon" name="search" autocomplete="off" />
                    <button type="submit" class="btn btn-outline-primary" name="search_product">search</button>
                </div>
            </div>
            <div class="form-group table_holder mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <!--<th class="table_btn">Update</th>-->
                            <th class="table_btn">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('includes/dbconnect.php');
                        $sql = "select * from products";

                        if (isset($_POST["search_product"])) {
                            include('includes/dbconnect.php');
                            $searchitem = mysqli_real_escape_string($conn, $_POST["search"]);
                            if ($searchitem == "") {
                                $sql = "select * from products";
                            } else {
                                $sql = "select * from products where Product_ID like '%" . $searchitem . "%' or Product_Name like '%" . $searchitem . "%'";
                            }
                        }

                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['Product_ID']; ?></td>
                            <td><?php echo $row['Product_Name']; ?></td>
                            <td><?php echo $row['Price']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <!--<td class="table_btn"><a href="updateproduct.php?pid=<?php //echo $row['Product_ID'];
                                                                                            ?>"><i class="fas fa-pencil-alt"></i></a></td>-->
                            <td class="table_btn"><i class="fas fa-trash"
                                    onclick="getsetdata(<?php echo $row['Product_ID']; ?>)" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"></i></td>
                        </tr>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Product</h5>
                                        <button type="button" class="btn-delete" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 id="modal_message"></h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <a id="modal_href" href="" class="btn btn-primary">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        include('includes/dbclose.php');
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script type="text/javascript">
    function getsetdata(idval) {
        document.querySelector('#modal_message').innerHTML = 'Do you really want to delete?';
        document.querySelector('#modal_href').href = 'delete.php?id=' + idval + '&status=product';
    }
    </script>
    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>