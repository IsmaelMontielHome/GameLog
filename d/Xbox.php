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
      <title>Xbox</title>
      <link rel="shortcut icon" href="img/xbi.png">
      <link rel="stylesheet" href="css/header.css">
      <link rel="stylesheet" href="css/plataforma/xbox.css">
      <link rel="stylesheet" href="css/visitante.css">
      <link rel="stylesheet" href="css/footer.css">
      <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet"
                href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
      
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
      <script src="js/scrollreveal.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <?php include ("Parte/headerus.html");?>
    <div>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
    <br>
    <div class="contenido">
      <ul class="list-group">
        <?php
          $query = "SELECT * FROM task WHERE seccion='Xbox' ORDER BY id DESC";
          $result_tasks = mysqli_query($conn, $query);
          while($row = mysqli_fetch_assoc($result_tasks)) { 
            $id = $row['Id'];
            $user_id = $row['uid'];
            $get_data_user = "SELECT * FROM usertable WHERE id = '$user_id' LIMIT 1";
            $get_data_user_run = mysqli_query($conn, $get_data_user);
            $rowUser = mysqli_fetch_assoc($get_data_user_run);
            $userName = $rowUser['name'];
            $creado = $row['created_at'];
        ?>
        <li class="list-group-item ri">
          <div class="caja-publicacionz">
            <div class="imagenz">
              <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion2">
              <p></p>
              <h1 class="titulo" style="font-size: 32px;"><?php echo $row['title']; ?></h1>
              <br>
              <h2 class="subtitulo" style="font-size: 20px;"><?php echo $row['subtitle']; ?></h2>
              <div class="detalles">
               
                <span class="seccion"><?php echo $row['seccion']; ?></span>
                <br>
                <br>
                <a href="/Gamelog5/ejemplophp/PubsCreator/Publicaciones/<?php echo $id?>.php">ver mas...</a>
              </div>
            </div>
            <div class="fecha-creacion">
              <div>
                <br>
                <br>
                </div>
                <span><p>Creado por: <?php echo $userName?></p></span>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
              </div>
                    
            </div>
        </li>
        <br><br>
        <?php
          } 
        ?>
      </ul>
    </div>
    <br><br><br>
    <div name="footer"id="footer"><?php include("Parte/footerus2.html")?></div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/header.js"></script>
  </body>
</html>