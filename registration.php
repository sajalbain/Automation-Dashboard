<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Opel | Control Panel</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<?php
include_once('session.php');
include_once("dbconfig.php");
if ($_SESSION['role'] != 'admin') {
  echo '<script>alert("Please contact admin! You dont have privledge to access this page"); window.location.href="/users.php";</script>';
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $corpid = mysqli_real_escape_string($db, $_POST['corpid']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $role = mysqli_real_escape_string($db, $_POST['roles']);
  $sql = "insert into users values('$firstname','$lastname','$corpid','$role',MD5('$password'),CURRENT_TIMESTAMP(),'1')";
  mysqli_query($db, $sql);
  header('location: users.php');
}
?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i>messages
              <span class="float-right text-muted text-sm">Count</span>
            </a>
            <div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php" role="button"><i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="dist/img/OpelLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Control Center</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/icon.png" class="img-circle" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['username'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Controls
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="stats.php" class="nav-link">
                <i class="far fas fa-file-invoice nav-icon"></i>
                <p>Automation Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/apps.php" class="nav-link">
                <i class="far fas fa-rocket nav-icon"></i>
                <p>Automation Status</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/appslist.php" class="nav-link">
                <i class="far fas fa-robot nav-icon"></i>
                <p>Automation List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/users.php" class="nav-link active">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User Management
                  <span class="right badge badge-danger">+</span>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Automation Control Panel</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Registration</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6 ">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">User Registration</h3>
                </div>
                <form action="" method="post">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="CORPID">CORP ID</label>
                      <input type="text" name="corpid" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="First Name">First Name</label>
                      <input type="text" name="firstname" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="Last Name">Last Name</label>
                      <input type="text" name="lastname" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="Password">Password</label>
                      <input type="password" name="password" class="form-control" placeholder="***********" required>
                    </div>

                    <div class="form-group">
                      <label for="role">Role</label>
                      <select id="role" name="roles" class="form-control">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="dev">Dev</option>
                        <option value="view">Viewer</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-info btn-block" value="Add">
                    </div>
                    <!-- /input-group -->
                  </div>
                </form>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Opel Automation Server</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>