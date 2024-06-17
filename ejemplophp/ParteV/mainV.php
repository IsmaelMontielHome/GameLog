<?php
  include("db.php");
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<main>
  
  <div class="pe">
    <h1 class="text-center">Previsualizacion</h1>
  </div>
  
  <div class="text-center text-dark">
    <?php
      $query = "SELECT * FROM task ORDER BY id DESC";
      $result_tasks = mysqli_query($conn, $query);    
      $row = mysqli_fetch_assoc($result_tasks);
      $id = $row['Id'];
      $user_id = $row['uid'];
      $get_data_user = "SELECT * FROM usertable WHERE id = '$user_id' LIMIT 1";
      $get_data_user_run = mysqli_query($conn, $get_data_user);
      $rowUser = mysqli_fetch_assoc($get_data_user_run);
      $userName = $rowUser['name'];
      $creado = $row['created_at']; ?>
  </div>
  <section class="caviar-hero-area" id="home">
            <!-- Single Slides -->
            <?php echo $row['image']="<img style='position: absolute; width: 100%; height: 100%;' src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            <div class="single-hero-slides bg-img">
                <div class="container h-100">
                    <div class="cont">
                        <div class="seccion"><p><?php echo $row['seccion']?><p></div>
                    </div>
                    <div class="row h-100 align-items-center" style="position: absolute; z-index: 5;">
                        <div class="col-11 col-md-6 col-lg-4">
                            <div class="hero-content">
                                <h2 style="margin-left: 10%;"><?php echo $row['title']; ?></h2>
                                <!--<p>Estos son los problemas y virtudes de la segunda mitad del juego.</p>-->
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
            <div class="card bordered-dark mt-5" style="width: 70em;">
            <a href="../ejemplophp/delete_task.php?id=<?php echo $row['Id']?>" class="btn btn-outline-danger mt-2 mb-1" onclick="borrarPublicación()"> 
    Cancelar
  </a>
  <!--<a href="create.php">Guardar</a>-->
  <a href="../ejemplophp/publicar.php?id=<?php echo $row['Id']?>" class="btn btn-outline-success mt-2 mb-1"  onclick="crearPublicación()">
    Guardar
  </a>
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
</main>
<br>