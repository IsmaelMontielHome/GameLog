<?php 
require_once "../Login/controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email' AND user_type = 0";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: login.php');
        }
    }else{
        header('Location: user-otp.php');
    }
}else{
    header('Location: login.php');
}
?>
<?php
include("db.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT visibilidad FROM task WHERE id = $id";
    $result1 = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result1);
    $visibilidad = $row['visibilidad'];
    if($visibilidad == 0)
    {
      $visibilidad = 1;
    }
    else
    {
      $visibilidad = 0;
    }
  
    $query = "UPDATE task set visibilidad = '$visibilidad' WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if(!$result) {
      die("Query Failed.");
    }
    $_SESSION['message'] = 'Task Removed Successfully';
    $_SESSION['message_type'] = 'danger';
    header('Location: posts.php');
  }
?>