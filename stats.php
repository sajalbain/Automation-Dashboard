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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<?php
include_once('session.php');
$run_query = "SELECT sum(runs) FROM apps";
$run_result = mysqli_query($db, $run_query);
$runs = mysqli_fetch_array($run_result);
$run_success_stat = "SELECT count(*) FROM apprunlog where exitstatus = '0'";
$run_success = mysqli_query($db, $run_success_stat);
$runs_success = mysqli_fetch_array($run_success);
$run_fail_stat = "SELECT count(*) FROM apprunlog where exitstatus = '1'";
$run_fail = mysqli_query($db, $run_fail_stat);
$runs_fail = mysqli_fetch_array($run_fail);
// $time_stat = "SELECT runtime FROM appruntime";
// $time_result = mysqli_query($db, $time_stat);
// while ($time = mysqli_fetch_array($time_result)){
//   $date = strtotime($time[0]);
//   $total = $total + $date;
// }
// $time_manual = "SELECT manualruntime FROM appruntime";
// $time_manual_result = mysqli_query($db, $time_manual);
// while ($time = mysqli_fetch_array($time_manual_result)){
//   $date = strtotime($time[0]);
//   $total_manual = $total_manual + $date;
// }
  
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
                <p>Controls</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link active">
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
              <a href="/appslist.php" class="nav-link">
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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Control Center</li>
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
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $runs[0]; ?></h3>
                  <p>Total Automation Runs</p>
                </div>
                <div class="icon">
                  <i class="fas fa-running"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo round(($runs_success[0]/$runs[0])*100);?><sup style="font-size: 20px">%</sup></h3>
                  <p>Successful Runs</p>
                </div>
                <div class="icon">
                  <i class="fas fa-check-circle"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo round(($runs_fail[0]/$runs[0])*100);?><sup style="font-size: 20px">%</sup></h3>
                  <p>Failure</p>
                </div>
                <div class="icon">
                  <i class="fas fa-exclamation-triangle"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <!-- <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo date('H:i:s', ($total_manual-$total)*31);?></h3>
                  <p>Time Saving(Monthly)</p>
                </div>
                <div class="icon">
                  <i class="fas fa-stopwatch"></i>
                </div>
              </div>
            </div> -->
            <!-- ./col -->
          </div>
          <div class="row">
            <div id="content">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Automation Run Report</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content p-0">
                      <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                        <canvas id="myChart" height="140" style="height: 200px; display: block; width: auto;" width="320" class="chartjs-render-monitor"></canvas>
                      </div>
                    </div>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card-body -->
              </div>
            </div>
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
        --
      </div>
      <!-- Default to the left -->
      <strong>Opel Automation Server</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/dist/js/adminlte.min.js"></script>
  <script>
    var ctx = document.getElementById('myChart');


    function loadJSON(callback) {

      var xobj = new XMLHttpRequest();
      xobj.overrideMimeType("application/json");
      xobj.open('GET', '/runreport.json', true); // Replace 'my_data' with the path to your file
      xobj.onreadystatechange = function() {
        if (xobj.readyState == 4 && xobj.status == "200") {
          // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
          callback(xobj.responseText);
        }
      };
      xobj.send(null);
    }

    function init() {
      loadJSON(function(response) {
        // Parse JSON string into object
        data = JSON.parse(response);
        console.log(data);
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.label,
            datasets: [{
                label: 'Success',
                data: data.success,
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
              },
              {
                label: 'Failure',
                data: data.failure,
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                borderWidth: 1
              }
            ]
          },
          options: {
            maintainAspectRatio: false,
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              xAxes: [{
                stacked: true,
              }],
              yAxes: [{
                stacked: true
              }]
            }
          }
        });
      });
    }

    init()
  </script>
</body>

</html>