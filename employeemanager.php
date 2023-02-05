<?php
  if(isset($_POST['add_employee'])){
    include('includes/dbconnect.php');
    $employeename=mysqli_real_escape_string($conn,$_POST['employeename']);
    $contactnumber=mysqli_real_escape_string($conn,$_POST['contactnumber']);
    $emailaddress=mysqli_real_escape_string($conn,$_POST['emailaddress']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $gender=mysqli_real_escape_string($conn,$_POST['gender']);
    $dobirth=mysqli_real_escape_string($conn,$_POST['dobirth']);
    $nationality=mysqli_real_escape_string($conn,$_POST['nationality']);
    $civilstatus=mysqli_real_escape_string($conn,$_POST['civilstatus']);
    $department=mysqli_real_escape_string($conn,$_POST['department']);
    $designation=mysqli_real_escape_string($conn,$_POST['designation']);
    $employeestatus=mysqli_real_escape_string($conn,$_POST['employeestatus']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $sql="insert into employees(Employee_Name,Contact_Number,Email_Address,Address,Gender,Date_of_Birth,Nationality,Civil_Status,Department,Designation,Employee_Status,Password)
    values('$employeename','$contactnumber', '$emailaddress', '$address','$gender','$dobirth', '$nationality', '$civilstatus','$department','$designation', '$employeestatus','$password')";
    mysqli_query($conn,$sql);

    include('includes/dbclose.php');
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
    <link rel="stylesheet" href="css/productstyle.css">
    <title>Employee Manager</title>
</head>
<body>
    <div class="container">
        <form action="#" method="post" class="px-5 py-4 mt-4 product_tbl" id="productadd" >
        <img src="images/logo.png" alt="" class="img-fluid" style="width: 200px; margin: 2em;">
            <div class="d-flex justify-content-between">
              <a href="Dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
              <h3 class="msg"></h3>
              <h4>Employees</h4>
            </div>
            <div class="form-group row">
                <div class="mb-3 col-sm">
                    <label for="employeename" class="form-label">Employee Name:</label>
                    <input type="text" class="form-control input_fields" id="employeename" placeholder="Employee Name" name="employeename" autocomplete="off"> 
                </div>
                <div class="mb-3 col-sm">
                    <label for="contactnumber" class="form-label">Contact Number:</label>
                    <input type="text" class="form-control input_fields" id="contactnumber" placeholder="Contact Number" name="contactnumber" autocomplete="off">
                </div>
                 <div class="mb-3 col-sm">
                    <label for="emailaddress" class="form-label">Email Address:</label>
                    <input type="email" class="form-control input_fields" id="emailaddress" placeholder="Email Address" name="emailaddress" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control input_fields" id="address" placeholder="Address" name="address" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="gender" class="form-label">Gender:</label>
                    <input type="text" class="form-control input_fields" id="gender" placeholder="Gender" name="gender" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="dobirth" class="form-label">Date of Birth:</label>
                    <input type="text" class="form-control input_fields" id="dobirth" placeholder="Date of Birth" name="dobirth" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="nationality" class="form-label">Nationality:</label>
                    <input type="text" class="form-control input_fields" id="nationality" placeholder="Nationality" name="nationality" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="civilstatus" class="form-label">Civil Status:</label>
                    <input type="text" class="form-control input_fields" id="civilstatus" placeholder="Civil Status" name="civilstatus" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="department" class="form-label">Department:</label>
                    <input type="text" class="form-control input_fields" id="department" placeholder="Department" name="department" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" class="form-control input_fields" id="designation" placeholder="Designation" name="designation" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                    <label for="employeestatus" class="form-label">Employee Status:</label>
                    <input type="text" class="form-control input_fields" id="employeestatus" placeholder="Employee Status" name="employeestatus" autocomplete="off">
                </div>
                <div class="mb-3 col-sm">
                <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control input_fields" id="password" placeholder="Password" name="password" autocomplete="off">
                </div>
            </div>
            <button type="submit" class="btn btn-primary add" name="add_employee">Add</button>
            <!--<div class="form-group mt-4">
                <div class="input-group">
                    <input type="search" class="form-control rounded" placeholder="Search Employee ID/Employee Name" aria-label="Search"
                    aria-describedby="search-addon" name="search"  autocomplete="off"/>
                    <button type="submit" class="btn btn-outline-primary" name="search_product">search</button>
                  </div>
            </div>-->
            <div class="form-group table_holder mt-4">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Contact Number</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <th class="table_btn">Update</th>
                        <th class="table_btn">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        include('includes/dbconnect.php');
                        $sql="select * from employees";
                        if(isset($_POST['search_product']))
                        {
                          $search=mysqli_real_escape_string($conn,$_POST['search']);
                          if($search==""){
                            $sql="select * from employees";
                          }else{
                            $sql="select * from employees where Employee_ID like '%".$search."%' or Employee_Name like '%".$search."%'";
                          }
                        }
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                      ?>
                      <tr>
                        <td><?php echo $row['Employee_ID'];?></td>
                        <td><?php echo $row['Employee_Name'];?></td>
                        <td><?php echo $row['Contact_Number'];?></td>
                        <td><?php echo $row['Email_Address'];?></td>
                        <td><?php echo $row['Address'];?></td>
                        <td class="table_btn"><a href="employeeupdate.php?cid=<?php echo $row['Employee_ID'];?>"><i class="fas fa-pencil-alt"></i></a></td>
                        <td class="table_btn"><i class="fas fa-trash" onclick="getsetdata(<?php echo $row['Employee_ID'];?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i></td>
                      </tr>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Delete Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <h4 id="modal_message"></h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
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
      function getsetdata(idval){
        document.querySelector('#modal_message').innerHTML='Do you really want to delete?';
        document.querySelector('#modal_href').href='delete.php?id='+idval+'&status=employee';
      }
    </script>
    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>