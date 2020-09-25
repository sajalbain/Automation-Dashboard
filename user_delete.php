<?php
include_once('session.php');
include_once("dbconfig.php");
$corpid = mysqli_real_escape_string($db,$_GET['corpid']);
$sql = "select firstname,lastname,corpid from users where corpid = '$corpid'";
mysqli_query($db,$sql);
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if($count && $_SESSION['role']=='admin' ) {
   $sql = "delete from users where corpid = '$corpid'";
   mysqli_query($db,$sql);
   header("location: users.php");
}else if($count && $_SESSION == $corpid){
    $sql = "delete from users where corpid = '$corpid'";
    mysqli_query($db,$sql);
    header("location: logout.php");
}else if($count==0){
    echo "<script>alert('User not available')</script>";
    //header("location: users.php");
}
else{
    echo "<script>alert('Contact Admin')</script>";
    //header("location: users.php");
}
?>