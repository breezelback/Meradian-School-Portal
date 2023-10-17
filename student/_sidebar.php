
  <?php

    $studLia = ' SELECT `id`, `student_id`, `academic_year_id`, `amount`, `status`, `date_created` FROM `tbl_liabilities` WHERE student_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'].' AND status = 0 ';
    $execLia = $conn->query($studLia);
   ?>
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
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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
            <a href="/meradian%20school%20portal/student/" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="view_student_academic.php" class="nav-link">
              <i class="nav-icon fa fa-copy"></i>
              <p>
                Enrolled Subjects
              </p>
            </a>
          </li>

          <?php if ($execLia->num_rows < 1): ?>
          <li class="nav-item">
            <a href="view_grades.php" class="nav-link">
              <i class="nav-icon fa fa-list-ol"></i>
              <p>
                My Grades
              </p>
            </a>
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a href="#" class="nav-link" style="cursor: not-allowed;" data-toggle="tooltip" data-placement="bottom" title="Please clear your pending liabilites!">
              <i class="nav-icon fa fa-list-ol"></i>
              <p>
                My Grades
              </p>
            </a>
          </li>
          <?php endif; ?>


          <li class="nav-item">
            <a href="student_liabilities.php" class="nav-link">
              <i class="nav-icon fa fa-exclamation-circle"></i>
              <p>
                My Liabilities
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
