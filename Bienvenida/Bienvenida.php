<?php require_once "../Login/controllerUserData.php"; ?>
<?php 
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
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login.php');
}
?>
<?php include("header.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>BIENVENIDA</title>
    <link rel="shortcut icon" type="image/png" href="logofinally2.png"/>
</head>
<body>
    <div class="container">
    <div class="card">
        <div class="box">
        <div class="content">
            <!--<h2 style="margin-bottom: 10px">ADMIN</h2>-->
            <h3 style="font-size: 69px">BIENVENIDO</h3>
            <h3 style="font-size: 55px"><?php echo $fetch_info['name'] ?></h3>
            <a class="btn btn-primary btn-lg" href="../ejemplophp/posts.php" role="button">¡Comience a Administrar!</a>
        </div>
        </div>
    </div>




</body>
</html>


                
