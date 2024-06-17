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
<?php
  include("db.php");
  $con=mysqli_connect('localhost','root','','login-php') or die('Error en la conexion servidor');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitante</title>
    <link rel="stylesheet" href="../d/css/fondo-texto.css"><!--manda a llamar los diseños-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'><!--manda a llamr iconos (Mariana)-->
    <!--Manda a llamar el css de bosstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="body"><!--La clase body es para que me cambie el color de la pagina-->
    <div class="row con"><!--La clase con es la que se encarga de que mi titulo se mueva-->
        <h1 class="text-center text-light">VISUALIZACION</h1>
    </div>
    <div class="espacio"></div><!--espacio-->
    <div class=" body container" ><!--lo pongo de color que quiera y lo centro-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<main>
  
  <div class="pe">
    <h1 class="text-center">Previsualizacion</h1>
  </div>
  
  <div class="text-center text-dark">
    <?php
      $query = "SELECT * FROM task ORDER BY id DESC";
      $result_tasks = mysqli_query($conn, $query);    
      $row = mysqli_fetch_assoc($result_tasks) ?>
      <h1><?php echo $row['title']; ?></h1>
      <?php echo $row['image']="<img width='auto' height='150px' src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
      <h3><?php echo $row['subtitle']; ?></h3>
      <p><?php echo $row['description']; ?></p>
      
  </div>
  <a href="posts.php" class="btn btn-primary">REGRESAR</a>

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
</main>
<br>
    </div>
    <div class="espacio"></div><!--espacio-->   
    <!--mando a llamar el js de boostrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>