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
<!DOCTYPE
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<?php
    include("../ejemplophp/db.php");
    $title = '';
    $description= '';
  
    $query = "SELECT * FROM usertable WHERE email = '$email' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $title = $row['name'];
        $image = $row['image'];
        $imagefondo = $row['image'];
        $description = $row['descripcion'];
    }
                    
                
    if (isset($_POST['actualizar'])) {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $query = "UPDATE usertable set image = '$image' WHERE email='$email'";
        mysqli_query($conn, $query);
        $_SESSION['message'] = 'Usertable Updated Successfully';
        $_SESSION['message_type'] = 'warning';
        header('Location: ejemplo.php');
    }
    if (isset($_POST['modificar'])) {
        $imagefondo = addslashes(file_get_contents($_FILES['fondo']['tmp_name']));
        $query = "UPDATE usertable set fondo = '$imagefondo' WHERE email='$email'";
        mysqli_query($conn, $query);
        $_SESSION['message'] = 'Usertable Updated Successfully';
        $_SESSION['message_type'] = 'warning';
        header('Location: ejemplo.php');
    }
    if (isset($_POST['update'])) {
      $title= $_POST['name'];
      $description = $_POST['descripcion'];
      $query = "UPDATE usertable set name = '$title', descripcion = '$description' WHERE email = '$email'";
      mysqli_query($conn, $query);
      $_SESSION['message'] = 'Usertable Updated Successfully';
      $_SESSION['message_type'] = 'warning';
      header('Location: ejemplo.php');
    }
    
?>
    <div class="main-content "style="z-index: 5">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
                    href="Visitante.php" style="z-index: 5"><i class="bi bi-arrow-left-circle flecha" ></i></a>
            </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
            style="min-height: 600px; background-size: cover; background-position: center top;">
            <!-- Mask -->
            <?php 
            if (filter_var($fetch_info['fondo'], FILTER_VALIDATE_URL)) {
                // Imprime la URL
                echo $fetch_info['fondo']="<img style='position: absolute; width: 100%; height: 100%' src='$imagefondo'>";
            } else {
                // Imprime la imagen en binario
                echo $fetch_info['fondo']="<img style='position: absolute; width: 100%; height: 100%' src='data:image/jpg;base64,".base64_encode($fetch_info['fondo'])."'>";
            }
            ?>
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center" style="position: absolute;z-index: 5">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <!--text-nowrap-->
                        <h1 class="d-inline display-2 text-white">BIENVENIDO </h1>
                        <h1 class="text-white text-nowrap display-2"><?php echo $fetch_info['name'] ?></h1>
                        <br><br>
                        <div class="text-white mt-0 mb-3 text-nowrap">
                            <a href="#!" class="btn btn-info" data-bs-target="#exampleModal" data-bs-toggle="modal" >Editar
                            perfil</a>
                            <a href="#!" class="btn btn-info" data-bs-target="#fondo" data-bs-toggle="modal" value="true">Editar
                            fondo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <!--Cards-->
        <div class="container-fluid mt--7 " style="z-index: 5">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow-lg p-3 mb-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-2 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#!" data-bs-target="#perfil" data-bs-toggle="modal">
                                        <div class="img text-center" alt="img-avatar">
                                            
                                            <?php 
                                             if (filter_var($fetch_info['image'], FILTER_VALIDATE_URL)) {
                                                echo $fetch_info['image']="<img class='rounded-circle' style='width: 200px; height: 200px;' src='$image'>";
                                            } else {
                                                echo $fetch_info['image']="<img class='rounded-circle' style='width: 200px; height: 200px;' src='data:image/jpg;base64,".base64_encode($fetch_info['image'])."'>";
                                            }?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-9 pt-md-4 pb-0 pb-md-4">
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <a href="#!" class="btn btn-info" data-bs-target="#perfil" data-bs-toggle="modal">Editar Foto</a>
                                </div>
                                <h3 class="font-weight-300-bold text-light">
                                    <?php echo $fetch_info['name'] ?>
                                </h3>
                                <div class="h3 font-weight-300 text-light">
                                    <i class="bi bi-envelope-at-fill mr-2"></i><?php echo $fetch_info['email'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1 mb-9">
                    <div class="card shadow-lg p-3 mb-5">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0 text-light text-uppercase">Mi perfil</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <h6 class="heading-small mb-4 text-light">Acerca de mi:</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused text-muted">
                                        <p>
                                            <?php echo $fetch_info['descripcion'] ?>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="perfil" tabindex="-1" aria-labelledby="ejemploLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ejemploLabel">Cambio de Foto de Perfil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form method="POST" enctype="multipart/form-data">
                            
                            <p class="text-dark">Ingrese una Imagen <input type="file" name="image"></p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primary" name="actualizar" >Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Perfil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <h1>Nombre de Usuario:</h1>
                                <textarea name="name" type="text" class="form-control"  placeholder="Update Title" cols="1" rows="1" required><?php echo $fetch_info['name'] ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <h1>Acerda de mi:</h1>
                                <textarea name="descripcion" class="form-control" cols="30" rows="10" required><?php echo $description;?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primary" name="update">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="fondo" tabindex="-1" aria-labelledby="ejemploFondo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ejemploFondo">Cambio del Fondo de Perfil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form method="POST" enctype="multipart/form-data">
                            
                            <p class="text-dark">Ingrese una Imagen <input type="file" name="fondo"></p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button class="btn btn-primary" name="modificar"value="true">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const perfil = document.getElementById('perfil')
        if (perfil) {
            perfil.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = perfil.querySelector('.modal-title')
                const modalBodyInput = perfil.querySelector('.modal-body input')

                modalTitle.textContent = `Edita tu Foto de Perfil `
                modalBodyInput.value = recipient
            })
        }
    </script>
    <script>
        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyInput = exampleModal.querySelector('.modal-body input')

                modalTitle.textContent = `Editar Perfil `
                modalBodyInput.value = recipient
            })
        }
    </script>
    <script>
        const exampleModal = document.getElementById('fondo')
        if (fondo) {
            fondo.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const recipient = button.getAttribute('data-bs-whatever')
                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = fondo.querySelector('.modal-title')
                const modalBodyInput = fondo.querySelector('.modal-body input')

                modalTitle.textContent = `Editar Perfil `
                modalBodyInput.value = recipient
            })
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</html>