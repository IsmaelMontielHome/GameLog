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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitante</title>
    <link rel="stylesheet" href="backgroundpost1.css">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/5f897f84ba.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="body-edit">
    <?php
    include("db.php");
    $title = '';
    $description= '';

    if  (isset($_GET['id'])) {
      $id = $_GET['id'];
      $_SESSION['idPost'] = $id;
      $query = "SELECT * FROM task WHERE id=$id";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $title = $row['title'];
        $subtitle= $row['subtitle'];
        $description = $row['description'];
        $image = $row['image'];
        $seccion = $row['seccion'];
      }
    }

    if (isset($_POST['update'])) {
      $id = $_GET['id'];
      $uid = $user_id;
      $title= $_POST['title'];
      $titleProcesado = mysqli_real_escape_string($conn, $title);
      $subtitle= $_POST['subtitle'];
      $subtitleProcesado = mysqli_real_escape_string($conn, $subtitle);
      $description = $_POST['description'];
      $descriptionProcesado = mysqli_real_escape_string($conn, $description);
      $seccion = $_POST['opcion'];
      $query = "UPDATE task set uid = '$uid', title = '$titleProcesado', subtitle = '$subtitleProcesado', description = '$descriptionProcesado', seccion = '$seccion' WHERE id=$id";
      mysqli_query($conn, $query);
      $_SESSION['message'] = 'Task Updated Successfully';
      $_SESSION['message_type'] = 'warning';
      header('Location: posts.php');
    }
  
    ?>
    <br>
    <div class="">
      <div class="row">
        <div class="col-md-8 mx-auto mb-3">
          <div class="card card-body" style="">
          <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <h1 class="text-center ml-4 editar">EDITAR PUBLICACIÓN</h1>
              <p class="text-center mt-3 " style="font-weight: 500">TÍTULO<p>
              <input name="title" type="text" class="form-control text-center titulo" style="font-weight: bold; font-size: 19px; box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;" value="<?php echo $title; ?>" placeholder="Update Title">
            </div>
            <div class="form-group">
              <p class="text-center mt-4 " style="font-weight: 500; ">SUBTÍTULO<p>
              <input name="subtitle" type="text" class="form-control text-center subtitulo" style="font-weight: bold; font-size: 19px; box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;" value="<?php echo $subtitle; ?>">
            </div>
            <div class="form-group">
            <p class="text-center mt-4 " style="font-weight: 500">DESCRIPCIÓN<p>
            <textarea name="description" class="form-control" cols="30" rows="10" style="font-weight: 400; font-size: 17px; box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;"><?php echo $description;?></textarea>
            </div>
            <div>
              <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        EDITAR IMAGEN
                        <?php
                            if  (isset($_GET['id'])) {
                              $id = $_GET['id'];
                              $query = "SELECT * FROM task WHERE id=$id";
                              $result = mysqli_query($conn, $query);
                              if (mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_array($result);
                                $image = $row['image'];
                              }
                            }
                    
                            if (isset($_POST['update'])) {
                              $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                              $query = "UPDATE task set image = '$image' WHERE id=$id";
                              mysqli_query($conn, $query);
                              $_SESSION['message'] = 'Task Updated Successfully';
                              $_SESSION['message_type'] = 'warning';
                              header('Location: posts.php');
                            }
                        ?>
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="">
                        <p class="text-dark text-center text-uppercase">Ingrese una Imagen
                          <div class="file-select1" style="margin-left: 38%" id="src-file1">
                          <input type="file" name="image"></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="form-group">
            <p class="text-center mt-3 " style="font-weight: 500;">SECCIÓN<p>
            <select class="form-control" id="opcion" name="opcion" style="font-weight: bold; font-size: 19px; box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;" onchange="sendData()" required>
                <option value=""  disabled selected >Seleccione una seccion</option>
                <option value="Pc" id="pc">Pc</option>
                <option value="Xbox" id="xbox">Xbox</option>
                <option value="PlayStation" id="play">Playstation</option>
                <option value="Nintendo" id="nintendo">Nintendo</option>
                <option value="MultiPlataforma" id="multi">Multiplataforma</option>
            </select>
        </div>
        <script>
              $(document).ready(function(){
                $.ajax({
                    type: 'POST',
                    url: 'cargarSeleccion.php',
                    data: {
                      'cargarSeleccion': true
                    },
                    success: function(response) {
                      console.log(response);
                        if(response == "Xbox"){
                          $("#xbox").prop("selected", true);
                        }
                        if(response == "Pc"){
                          $("#pc").prop("selected", true);
                        }
                        if(response == "Nintendo"){
                          $("#nintendo").prop("selected", true);
                        }
                        if(response == "PlayStation"){
                          $("#play").prop("selected", true);
                        }
                        if(response == "MultiPlataforma"){
                          $("#multi").prop("selected", true);
                        }
                    }
                });
              })
            function sendData() {
                var opcion = $('#opcion').val();
                $.ajax({
                    type: 'POST',
                    url: 'edit.php',
                    data: {opcion: opcion},
                    success: function(data) {
                        $('#resultado').val(data);
                    }
                });
            }
        </script>
            <div class="mt-5 d-flex justify-content-around">
              <a href="posts.php" class="btn btn btn-regre">REGRESAR</a>
              <button class=" btn btn-guar" name="update" onclick="crearPublicación()">GUARDAR</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    <script>
       function crearPublicación(){
      $.ajax({
        type: "POST",
        url: "../ejemplophp/PubsCreator/guardar_publicacion.php",
        data: {
          'guardar': true
        },
        success: function(response){
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
 
      })
    }
    </script>

    <script>
      function actualizarInputFile() {
      var filename = "'" + this.value.replace(/^.*[\\\/]/, '') + "'";
      this.parentElement.style.setProperty('--fn', filename);
      }
      document.querySelectorAll(".file-select1 input").forEach((ele)=>ele.addEventListener('change', actualizarInputFile));
      </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>