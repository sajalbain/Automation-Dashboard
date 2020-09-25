<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Opel | Control Center</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<?php
include_once("dbconfig.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  $sql = "SELECT corpid,firstname,active,role FROM users WHERE corpid = '$username' and password = md5('$password')";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $active = $row['active'];
  $user = $row['firstname'];
  $role = $row['role'];
  $count = mysqli_num_rows($result);
  if ($count == 1 && $active == 1) {
    $_SESSION['login_user'] = $username;
    $_SESSION['username'] = $user;
    $_SESSION['role'] = $role;
    header("location: index.php");
  } else {
    if ($active == 0 && $count == 1) {
      $error = "Your account is inactive";
    } else if ($count == 0) {
      $error = "Your Login Name or Password is invalid";
    } else {
      $error = "Contact Admin";
    }
    echo $error;
  }
  $sql = "update users set lastlogin = CURRENT_TIMESTAMP() where corpid = '$username' and password = md5('$password')";
  mysqli_query($db, $sql);
}
$sql1 = "SELECT lastrun FROM apps WHERE AppName='BMW Ticket Dispatcher'";
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
date_default_timezone_set("Asia/Kolkata");
$diff = abs(strtotime(date("Y-m-d H:i:s")) - strtotime($row1['lastrun']));
$minutes = floor(($diff - $years * 365 * 60 * 60 * 24
  - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
  - $hours * 60 * 60) / 60);
?>

<body class="hold-transition login-page bg">
  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>Automation</b> Control Panel</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Log in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" name='username' class="form-control" placeholder="CORP ID" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name='password' class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-key"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <input type="submit" class="btn btn-primary btn-block" value='Log In'>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <br />
        <?php
        if ($minutes > 5) {

        ?>
          <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon far fa-hand-paper"></i> Dispatcher Halted!</h5>
            Since Last Run <?php echo $minutes; ?> minutes has passed. Please contact administrator.
          </div>
        <?php
        } else {
        ?>
          <div class="alert alert-success alert-dismissible">
            <h5><i class="icon fas fa-running"></i> Dispatcher Running</h5>
            Since Last Run at <?php echo $minutes; ?> minutes has passed.
          </div>
        <?php
        }
        ?>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>

</body>

</html>