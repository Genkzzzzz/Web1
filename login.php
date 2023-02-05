<?php
include('includes/dbconnect.php');
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($conn, $_POST['useremail']);
  $pass = mysqli_real_escape_string($conn, $_POST['userpass']);

  $sql = "select * from employees where Email_Address='$email' and Password='$pass'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_num_rows($result);
  if ($row > 0) {
    while ($set = mysqli_fetch_assoc($result)) {
      $name = $set['Employee_Name'];
      header("location:Dashboard.php?employeename=$name");
    }
  }
  /*if($user=="ADMIN@gmail.com" && $pass=="ADMIN123"){
          $message = "Login Completed";
          echo "<script type='text/javascript'>alert('$message');</script>";
          header('location: Dashboard.php');
        }else{
          $message = "INCORRECT EMAIL AND PASSWORD";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }*/
}
include('includes/dbclose.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/loginstyle.css">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <section class="vh-100">
            <div class="container py-2 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img src="images/logo.png" alt="" class="img-fluid">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your Email and Password!</p>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                            name="useremail" />
                                        <label class="form-label" for="typeEmailX">Email</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                            name="userpass" />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                        name="login">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>