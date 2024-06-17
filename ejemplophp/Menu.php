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
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="menu.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
        <i class='bx bxs-game icon'></i>
        <div class="logo_name">GameLog</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="Menu.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">DASHBOARD</span>
        </a>
         <span class="tooltip">DASHBOARD</span>
      </li>
      <li>
       <a href="posts.php">
        <i class='bx bx-notepad'></i>
         <span class="links_name">PUBLICACIONES</span>
       </a>
       <span class="tooltip">PUBLICACIONES</span>
     </li>
     <li>
       <a href="../d/modoVisitante.php">
        <i class='bx bxs-user-rectangle'></i>
         <span class="links_name">MODO VISITANTE</span>
       </a>
       <span class="tooltip">VISITANTE</span>
     </li>
<!--     <li>
       <a href="#">
        <i class='bx bxs-cog'></i>
         <span class="links_name">SETTINGS</span>
       </a>
       <span class="tooltip">SETTINGS</span>
     </li>
     
     <li>
       <a href="#">
         <i class='bx bx-cog' ></i>
         <span class="links_name">PROFILE</span>
       </a>
       <span class="tooltip">PROFILE</span>
     </li>
-->
     <li class="profile">
         <div class="profile-details">
           <!--<img src="profile.jpg" alt="profileImg">-->
           <div class="name_job">
             <div class="name">ADMINISTRADOR</div>
             <div class="job"><?php echo $fetch_info['name'] ?></div>
           </div>
         </div>
          <i>
            <form action="../Login/cerrar_sesion.php ">
              <button class='bx bx-log-out' id="log_out"></button>
            </form>
          </i>
     </li>
     <!--<button type="button" class="btn btn-light"><a href="../Login/cerrar_sesion.php">Cerrar Sesion</a></button>-->
    </ul>
  </div>
  <section class="home-section">
        <div class="text">DASHBOARD</div>
        <div class="bodytext">
          <iframe class="dashboard" src="dashboard.php" frameborder="0"></iframe> <!---//footer-->
        </div>
  </section>
<script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
});
  </script>
</body>
</html>