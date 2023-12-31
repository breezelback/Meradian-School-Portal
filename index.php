<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Meradian School | Portal</title>

  <link rel="icon" href="images/logo.jpg" type="image/gif">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"  />
</head>
<body class="layout-fixed bg-light">

<!-- main -->
<div class="container mt-3">
  <div class="row justify-content-center align-items-center text-center p-2">
    <div class="m-1 col-sm-8 col-md-6 col-lg-4 shadow-sm p-3 mb-5 bg-white border rounded">
      <div class="pt-2 pb-5">
        <img class="rounded mx-auto d-block" src="images/logo.jpg" alt="" width=150px height=150px>
        <p class="text-center text-uppercase mt-3">The Meradian School Portal Login</p>
        <form class="form text-center" action="function_php/login.php" method="POST">
          <div class="form-group input-group-md">
            <input type="text" class="form-control" name="id_number" id="id_number" aria-describedby="emailHelp" placeholder="Enter ID Number">
            <!--<div class="invalid-feedback">
               Errors in email during form validation, also add .is-invalid class to the input fields
            </div> -->
          </div>
          <div class="form-group input-group-md">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <!--<div class="invalid-feedback">
               Errors in password during form validation, also add .is-invalid class to the input fields
            </div> -->
          </div>

          <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="show_password" onclick="showPass()">
              <label class="form-check-label" for="show_password">
              Show Password
              </label>
          </div>

          <div class="form-group small clearfix mt-4">
              <label class="checkbox-inline">CAPTCHA</label>
              &nbsp;&nbsp;<img src="captcha.php" > &nbsp;&nbsp; <a href=""><i class="fa fa-sync"></i></a>
          </div> 
          <div class="form-group">
            <center>
              <input type="text" name="captcha_code" class="form-control form-control-sm" placeholder="CAPTCHA Code" required="required" style="font-size: 13px; width: 60%;">
            </center>
          </div>

          <button class="btn btn-block btn-primary mt-4" type="submit">
            Login <i class="fa fa-arrow-right"></i>
          </button>
          <a  data-toggle="modal" data-target="#modal_add_subject" class="float-right mt-2" style="cursor: pointer;">Forgot Password? </a>
          <!-- <button class="nav-link btn-success text-white"  data-toggle="modal" data-target="#modal_add_subject">Add New Subject &nbsp;<i class="fa fa-plus"></i></button> -->
        </form>
      </div>
      <!-- <a href="#" class="text-center d-block mt-2">Create an account? </a> -->
    </div>
  </div>
</div>
<!-- ./main -->

 <!-- Modal -->
<form action="function_php/reset_password.php" method="POST">
  <div class="modal fade" id="modal_add_subject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="name-l" style="color: grey;">Enter your ID Number</i></label>
          <input type="text" required="" class="form-control" name="id_number" id="id_number" placeholder="">
          <label for="name-l" style="color: grey;">Email Address</i></label>
          <input type="email" required="" class="form-control" name="email" id="email" placeholder="">
        </div>
        <div class="modal-footer">  
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>

<footer class="bg-white">
    <!-- Copyrights -->
    <!-- <div class="bg-light py-4"> -->
    <div class="py-4">
      <div class="container text-center">
        <p class="text-muted mb-0 py-2">© The Meradian School 2023 All rights reserved.</p>
      </div>
    </div>
  </footer>
  <!-- End -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" ></script>

<script>

  function showPass() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  
  <?php 
    if (isset($_SESSION['toastr'])) 
    {
      // echo 'toastr.'.$_SESSION['toastr']['type'].'("'.$_SESSION['toastr']['message'].'", "'.$_SESSION['toastr']['title'].'")';
      echo "iziToast.show({ title: '".$_SESSION['toastr']['title']."', message: '".$_SESSION['toastr']['message']."',theme: 'light',position: 'topRight',color: '".$_SESSION['toastr']['color']."'});";
      unset($_SESSION['toastr']);
    }
   ?>

</script>


</body>
</html>
