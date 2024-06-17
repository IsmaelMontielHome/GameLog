<?php include("../ejemplophp/db.php"); ?>  
<?php 
require_once "../Login/controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email' AND user_type = 1";
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
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Publicaciones</title>
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/publicaciones.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet"
                href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
      
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
        <script src="js/scrollreveal.js"></script>
</head>
<body >
  <?php include ("Parte/headerus.html");?>
    <div>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
    <div class="cont"><h1>Elije una seccion</h1></div>
    <div class="cont ri">
        <div class="caja " id="caja1">
            <a href="Xbox.php"><img src="img/xbox.png" alt="Imagen"></a>
        </div>
        <div class="caja2 " id="caja2">
            <a href="Nintendo.php"><img src="img/nintendo.png" alt="Imagen"></a>
        </div>
        <div class="caja3 " id="caja3">
            <a href="Playstation.php"><img src="img/play.jpg" alt="Imagen"></a>
        </div>
        <div class="caja4 " id="caja4">
            <a href="Pc.php"><img src="img/pc 1.jpg" alt="Imagen"></a>
        </div>
    </div>
    <br>
    <div class="contenido">
      <ul class="list-group">
        <?php
          $query = "SELECT * FROM task ORDER BY id DESC";
          $result_tasks = mysqli_query($conn, $query);    
          while($row = mysqli_fetch_assoc($result_tasks)) { 
            $id = $row['Id'];

        ?>
        <li class="list-group-item ri">
          <div class="caja-publicacionz">
            <div class="imagenz">
              <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion">
              <h1 class="titulo"><?php echo $row['title']; ?></h1>
              <h2 class="subtitulo"><?php echo $row['subtitle']; ?></h2>
              <div class="detalles">
               
                <span class="seccion"><?php echo $row['seccion']; ?></span>
                <br>
                <br>
                <?php echo '<a  class="leer-mas" href="/Gamelog5/ejemplophp/PubsCreator/Publicaciones/'.$id.'.php">ver mas...</a>';?>
              </div>
            </div>
            <div class="fecha-creacion">
              <div>
                <br>
                <br>
                </div>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
              </div>
                    
            </div>
        </li>
        <?php
          } 
        ?>
      </ul>
    </div>
    <br>
    <div name="footer"id="footer"><?php include("Parte/footerus2.html")?></div>

    <script type="text/javascript" src="js/header.js"></script>
    <script  src="js/caja_seccion.js"></script>
    <script  src="js/index.js"></script>
</body>
</html>


