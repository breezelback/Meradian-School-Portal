
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item">
        <button class="nav-link bg-danger btn-sm" role="button" onclick="logout();">
          Logout <i class="fas fa-power-off"></i>
        </button>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../images/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size: 17px;">Meradian School Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if ($_SESSION['profile_picture'] == ""): ?>
            <img src="../images/user_image.jpg" class="img-circle elevation-2" alt="User Image">
          <?php else: ?>
            <img src="../images/user/<?php echo $_SESSION['profile_picture']; ?>" class="img-circle elevation-2" alt="User Image">
          <?php endif ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['lastname']; ?>, <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['middlename']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/meradian%20school%20portal/teacher/" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="students.php" class="nav-link">
              <i class="nav-icon fa fa-copy"></i>
              <p>
                My Students
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="teacher_schedule.php" class="nav-link">
              <i class="nav-icon fas fa-calendar-week"></i>
              <p>
                My Schedule
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="teacher_dtr.php" class="nav-link">
              <i class="nav-icon fas fa-user-clock"></i>
              <p>
                Daily Time Record
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="student_grading.php" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Student Grading
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="edit_user.php" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Update Profile
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

<script>
  function logout()
  {
    if (confirm('Are you sure you want to logout?')) {
      // Save it!
      window.location = '../function_php/logout.php';
    } else {
      // Do nothing!
    }
  }
</script>
