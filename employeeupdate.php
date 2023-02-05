<?php
  $employeeid=$_GET['cid'];
  if($employeeid == "")
  {
      header('location:employeemanager.php');
  }
  include('includes/dbconnect.php');

  $sql="Select * from employees where Employee_ID='$employeeid'";
  $result=mysqli_query($conn,$sql);


  if(isset($_POST['update_employee']))
  {
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

      $sql="update employees set Employee_Name='$employeename',Contact_Number='$contactnumber',Email_Address='$emailaddress',Address='$address',
       Gender='$gender', Date_of_Birth='$dobirth',Nationality='$nationality',Civil_Status='$civilstatus',Department='$department',Designation='$designation',Employee_Status='$employeestatus'
        where Employee_ID='$employeeid'";
      mysqli_query($conn,$sql);

      include('includes/dbclose.php');
      header('location:employeemanager.php');
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
            <?php
                while($row=mysqli_fetch_assoc($result))
                {      
            ?>
            <div class="d-flex justify-content-between">
              <a href="employeeupdate.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
              <h3 class="msg"></h3>
              <h4>Employees</h4>
            </div>
            <div class="form-group row">
                <div class="mb-3 col-sm">
                    <label for="employeename" class="form-label">Employee Name:</label>
                    <input type="text" class="form-control input_fields" id="employeename" placeholder="Employee Name" name="employeename" autocomplete="off" value="<?php echo $row['Employee_Name']; ?>"> 
                </div>
                <div class="mb-3 col-sm">
                    <label for="contactnumber" class="form-label">Contact Number:</label>
                    <input type="text" class="form-control input_fields" id="contactnumber" placeholder="Contact Number" name="contactnumber" autocomplete="off" value="<?php echo $row['Contact_Number']; ?>">
                </div>
                 <div class="mb-3 col-sm">
                    <label for="emailaddress" class="form-label">Email Address:</label>
                    <input type="email" class="form-control input_fields" id="emailaddress" placeholder="Email Address" name="emailaddress" autocomplete="off" value="<?php echo $row['Email_Address']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control input_fields" id="address" placeholder="Address" name="address" autocomplete="off" value="<?php echo $row['Address']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="gender" class="form-label">Gender:</label>
                    <input type="text" class="form-control input_fields" id="gender" placeholder="Gender" name="gender" autocomplete="off" value="<?php echo $row['Gender']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="dobirth" class="form-label">Date of Birth:</label>
                    <input type="text" class="form-control input_fields" id="dobirth" placeholder="Date of Birth" name="dobirth" autocomplete="off" value="<?php echo $row['Date_of_Birth']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="nationality" class="form-label">Nationality:</label>
                    <input type="text" class="form-control input_fields" id="nationality" placeholder="Nationality" name="nationality" autocomplete="off" value="<?php echo $row['Nationality']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="civilstatus" class="form-label">Civil Status:</label>
                    <input type="text" class="form-control input_fields" id="civilstatus" placeholder="Civil Status" name="civilstatus" autocomplete="off" value="<?php echo $row['Civil_Status']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="department" class="form-label">Department:</label>
                    <input type="text" class="form-control input_fields" id="department" placeholder="Department" name="department" autocomplete="off" value="<?php echo $row['Department']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" class="form-control input_fields" id="designation" placeholder="Designation" name="designation" autocomplete="off" value="<?php echo $row['Designation']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    <label for="employeestatus" class="form-label">Employee Status:</label>
                    <input type="text" class="form-control input_fields" id="employeestatus" placeholder="Employee Status" name="employeestatus" autocomplete="off" value="<?php echo $row['Employee_Status']; ?>">
                </div>
                <div class="mb-3 col-sm">
                    
                </div>
            </div>
            <button type="submit" class="btn btn-primary add" name="update_employee">Update</button>
          </form>
          <?php
                }
                include('includes/dbclose.php');
            ?>
    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>