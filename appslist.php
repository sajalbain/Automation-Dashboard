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
include_once('dbconfig.php')
?>
<?php
$sql = "SELECT appname,path,triggertime,DATE_FORMAT(lastrun,'%d-%m-%Y %H:%i:%S'),exitcode,error FROM apps";
$result = mysqli_query($db, $sql);
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
              <a href="apps.php" class="nav-link">
                <i class="far fas fa-rocket nav-icon"></i>
                <p>Automation Status</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fas fa-robot nav-icon"></i>
                <p>Automation List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/users.php" class="nav-link">
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
                <li class="breadcrumb-item active">Automation Management</li>
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
            <div class="col-lg-6">
              <span>
              </span>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title">User List</h2>
                  <div>
                    <?php
                    if ($_SESSION['role'] == 'admin') {
                    ?>
                      <a href="/appregistration.php" class='btn btn-info' style="float:right;margin:5px;">Add New Automation</a>
                    <?php } ?>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Automation Name</th>
                        <th>Path</th>
                        <th>Last Run</th>
                        <th>Exit Code</th>
                        <th colspan="2">Actions</th>
                      </tr>
                    </thead>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                      <tbody>
                        <tr>
                          <td><?php echo $row[0]; ?></td>
                          <td><?php echo $row[1]; ?></td>
                          <td><?php echo $row[3]; ?></td>
                          <td><?php echo $row[4]; ?></td>
                          <td>
                            <form action="/appdetails.php/" method="post">
                              <input type="hidden" value="<?php echo $row[0]; ?>" name="appname" />
                              <input type="submit" formmethod="post" formaction="/appdetails.php" class="btn btn-block btn-info btn-sm" value="Edit" />
                            </form>
                          </td>
                          <td>
                            <button onclick="alert('<?php echo md5($row[0]); ?>')" class="btn btn-block btn-warning btn-sm">API Key</button>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
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