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
$sql = "SELECT firstname,lastname,corpid,lastlogin,active FROM users";
$result = mysqli_query($db, $sql);
$sql_app = "SELECT appname,path,triggertime,DATE_FORMAT(lastrun,'%d-%m-%Y %H:%i:%S'),exitcode,error FROM apps";
$result_app = mysqli_query($db, $sql_app);
?>
<script>
  function trigger(file, apikey) {
    var http = new XMLHttpRequest();
    var url = 'http://inmum-opel-vm:85/trigger';
    var params = "file=" + file + "&apikey=" + apikey;
    http.open('POST', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
  }
</script>

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
              <a href="#" class="nav-link  active">
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
              <a href="users.php" class="nav-link">
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
                <li class="breadcrumb-item active">Automations</li>
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
                  <h2 class="card-title">Applications</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered">
                    <tbody>
                      <tr>
                        <?php
                        $rtrack = 0;
                        while ($row_app = mysqli_fetch_array($result_app)) { //echo $row_app[0];
                          //echo "Tracking row ".$rtrack."<br>";
                          $rtrack = $rtrack + 1;
                        ?>
                          <td>
                            <div class="alert alert-info">
                              <h5><i class="icon fas fa-cogs"></i><?php echo $row_app[0]; ?></h5>
                              <?php
                              $file = explode("\\", $row_app[1]);
                              echo "<strong>Trigger File</strong>: " . end($file);
                              echo "<br><strong>Triggered Time</strong>: " . $row_app[2];
                              echo "<br><strong>Last Run</strong>: " . $row_app[3];
                              if ($row_app[4] == '0') {
                                echo "<br><strong>Last Run Status  :  </strong><button class='btn btn-success btn-xs'>Success</button>";
                              } else if ($row_app[4] == '2') {
                                echo "<br><strong>Last Run Status  :  </strong><button class='btn btn-warning btn-xs'>Running</button>";
                              } else if ($row_app[4] == '1') {
                                echo "<br><strong>Last Run Status  :  </strong><button class='btn btn-danger btn-xs'>Error</button>";
                                if (strlen(strlen($row_app[5]) > 1)) {
                                  echo "<br><strong>Error  :  </strong><button class='btn btn-danger btn-xs'>" . $row_app[5] . "</button>";
                                }
                              }
                              if(end($file) != 'null'){
                                echo "<br><strong>Run Now  :  </strong><button onclick=trigger('" . end($file) . "','" . md5($row_app[0]) . "') class='btn btn-primary btn-xs'>Run</button>";
                              }
                              ?>
                            </div>
                          </td>
                          <?php
                          if ($rtrack == 3) {
                            $rtrack = 0;
                          ?>
                      </tr>
                      <tr>
                    <?php
                          }
                        }
                    ?>
                      </tr>
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