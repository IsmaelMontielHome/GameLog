<?php 
require_once "../Login/controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$user_id = $_SESSION['auth_user_id'];
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
  $con=mysqli_connect('localhost','root','','login-php') or die('Error en la conexion servidor');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Visualizar</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">
    <!-- Responsive CSS -->
    <link href="previsua.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>
<?php
    if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM task WHERE id = '$id'";
    $result_tasks = mysqli_query($conn, $query);    
    $row = mysqli_fetch_assoc($result_tasks);
    $id = $row['Id'];
    $user_id = $row['uid'];
    $get_data_user = "SELECT * FROM usertable WHERE id = '$user_id' LIMIT 1";
    $get_data_user_run = mysqli_query($conn, $get_data_user);
    $rowUser = mysqli_fetch_assoc($get_data_user_run);
    $userName = $rowUser['name'];
    $creado = $row['created_at'];
    $imagen = base64_encode($row['image']);
    }?>

    <section class="caviar-hero-area" id="home">
            <!-- Single Slides -->
            <?php echo $imagen="<img style='position: absolute; width: 100%; height: 100%;' src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            <div class="single-hero-slides bg-img">
                <div class="container h-100">
                    <div class="cont">
                        <div class="seccion"><p><?php echo $row['seccion']?><p></div>
                    </div>
                    <div class="row h-100 align-items-center" style="position: absolute; z-index: 5;">
                        <div class="col-11 col-md-6 col-lg-4">
                            <div class="hero-content">
                                <h2 style="margin-left: -15%; font-size: 2.3em"><?php echo $row['title']; ?></h2>
                                <!--<p>Estos son los problemas y virtudes de la segunda mitad del juego.</p>-->
                                <a href="posts.php" class="btn btn-primary">REGRESAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="caviar-dish-menu mt-5 justify-content-between" id="menu" name="text">
        <div class="row justify-content-center">
            <div class="card bordered-dark mt-3" style="width: 70em; height: auto">
                <div class="card-body">
                    <h2 class="text-center text-uppercase mt-4 sub" style="width: 33em; margin-bottom: 70px"><?php echo $row['subtitle']; ?></h2>
                    <div class="d-flex justify-content-around">
                        <p class="text-light" style="font-size: 18px"><i class="bi bi-person-fill"></i> Creado por: <?php echo $userName;?> </p>
                        <img>
                        <p class="text-light" style="font-size: 18px"> <i class="bi bi-calendar-minus"></i> Fecha: <?php echo $row['created_at']; ?></p>
                    </div>
                </div>
            </div>
            <div class="card bordered-dark mt-5" style="width: 70em;">
                <div class="card-body text-light" style="font-size: 20px; margin-top: 3%; margin-left: 2%; margin-right: 2%; margin-bottom: 5%">
                <?php echo $row['description']; ?>
            </div>
        </div>
    <div>
</section>
<script>
     function crearPublicación(){
      $.ajax({
        type: "POST",
        url: "../ejemplophp/PubsCreator/guardar_publicacion.php",
        data: {
          'guardar': true
        },
        success: function(response){
        }
 
      })
    }
    function borrarPublicacion(){
      var id = <?php echo $row['Id'];?>;
      $.ajax({
        type: "POST",
        url: "../ejemplophp/PubsCreator/guardar_publicacion.php",
        data: {
          'id': id,
          'eliminar': true
        },
        success: function(response){
        }
 
      })
    }
  </script>

</body>
</html>