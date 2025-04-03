<?php 
session_start();
if (isset($_SESSION['admin_id'])) {
  header("location:admin/index.php");
}elseif(isset($_SESSION['station_id'])){
  header("location:station/index.php");
}elseif(isset($_SESSION['team_id'])){
  header("location:fireEngine/index.php");
}
?>

<?php 
if (isset($_GET['status'])) {
    $status=$_GET['status'];
    $msg="Username or password not correct";
}
 ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/truck.png" />

    <!-- Custom fonts for this template-->
    <link
      href="assets/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body class="bg-gradient-light">
    <div class="container ">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-5 mt-5 ">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 bg-gradient-light">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Login!</h1>
<?php if(isset($msg)){ ?>
    <div class="alert alert-<?=$status?> alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=$msg?></div>
<?php } ?>
                    </div>
                    <form method="POST" action="login_code.php" class="user" >
                      <div class="form-group">
                        <input type="text" name="user_name" class="form-control form-control-user" id="exampleInputEmail" placeholder="Enter User Name..." required 
                        />
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required />
                      </div>
                      <div class="form-group">
                        <!-- <div class="custom-control custom-checkbox small">
                          <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customCheck"
                          />
                          <label class="custom-control-label" for="customCheck"
                            >Remember Me</label
                          >
                        </div> -->
                      </div>
                      <input type="submit" name="login" value="LOGIN" class="btn btn-danger btn-user btn-block">
                    </form>
                    <hr />
                    <!-- <div class="text-center">
                      <a class="small" href="forgot-password.html"
                        >Forgot Password?</a
                      >
                    </div>
                    <div class="text-center">
                      <a class="small" href="register.html"
                        >Create an Account!</a
                      >
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
  </body>
</html>
