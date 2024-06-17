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
<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="logofinally2.png"/>
    <title>PUBLICACIONES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5f897f84ba.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="modaldesign.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="backgroundpost1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body id="body-pd">
    <div class="re">
    <header class="header" id="header">
        <div class="header_toggle"> 
            <i class='bx bx-menu' id="header-toggle"></i> 
        </div>
        <h3 class="align-items-center">PUBLICACIONES</h3>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> 
                    <img class="header_img" src="logofinally2.png" alt="">
                    <span class="nav_logo-name">GAMELOG</span>
                </a>

                <div class="nav_list">
                    <a href="posts.php" class="nav_link">
                        <i class='bx bx-notepad nav_icon' data-toggle="tooltip" title="PUBLICACIONES" data-bs-placement="right" data-bs-custom-class="custom-tooltip2"></i>
                        <span class="nav_name text-uppercase">PUBLICACIONES</span>
                    </a> 
                    
                    <a href="modoVisitante.php" class="nav_link">
                        <i class='bx bxs-user-rectangle nav_icon' data-toggle="tooltip" title="MODO VISITANTE" data-bs-placement="right" data-bs-custom-class="custom-tooltip2"></i>
                        <span class="nav_name text-uppercase">MODO VISITANTE</span>
                    </a> 
                    
                    <a href="../Login/agregar.php" class="nav_link">
                        <i class='bi bi-person-plus-fill nav_icon' data-toggle="tooltip" title="AGREGAR ADMIN" data-bs-placement="right" data-bs-custom-class="custom-tooltip2"></i>
                        <span class="nav_name text-uppercase">AGREGAR ADMIN</span>
                    </a>
                    
                </div>
            </div>

            <a href="../Login/cerrar_sesion.php " class="nav_link" id="profile">
                <i class='bx bx-log-out nav_icon'></i>
                <div class="name_job">
                    <span class="name">ADMINISTRADOR</span>
                    <div class="job"><?php echo $fetch_info['name'] ?></div>
                </div>
                
            </a>
        </nav>
    </div>
    <div>
    <!--Container Main start-->
    <div class="btn-pos d-flex justify-content-center mb-3">
        <button type="button" class="btn" id="btn-er" data-bs-toggle="modal" data-bs-target="#exampleModal">CREAR PUBLICACION</button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 35%"; role="document">
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save_task.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="message-text" class="form-label mt-2">TITULO</label>
                            <input type="text" name="title" class="form-control" id="form-control" autofocus required>
                        </div>
                        <div class="form-group">
                            <label class="form-label mt-2">SUBTITULO</label>
                            <input type="text" name="subtitle" class="form-control" id="form-control" autofocus  required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-label mt-2">DESCRIPCIÓN</label>
                            <textarea name="description" rows="2" class="form-control" id="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="form-label">IMAGEN</label><br>
                            <div class="file-select" id="src-file1">
                                <input class="text-center" type="file" name="image" required>
                            </div>   
                        </div>              
                        <div class="form-group">
                            <label for="opcion" class="text-uppercase">Seccion:</label>
                            <select class="form-control" id="opcion" name="opcion" onchange="sendData()" required>
                                <option value=""  disabled selected >Seleccione una seccion</option>
                                <option value="Pc" id="pc">Pc</option>
                                <option value="Xbox" id="xbox">Xbox</option>
                                <option value="PlayStation" id="play">Playstation</option>
                                <option value="Nintendo" id="nintendo">Nintendo</option>
                                <option value="MultiPlataforma" id="multi">Multiplataforma</option>
                            </select>
                        </div>
                        <script>
                        function sendData() {
                            var opcion = $('#opcion').val();
                            $.ajax({
                                type: 'POST',
                                url: 'save_task.php',
                                data: {opcion: opcion},
                                success: function(data) {
                                    $('#resultado').val(data);
                                }
                            });
                        }
                        </script>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancelar" id="border" data-bs-dismiss="modal">CANCELAR</button>
                            <form>
                                <input type="submit" name="save_task" class="btn btn-guardar text-light" id="border" value="SIGUIENTE">
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-bordered display-flexbox" id="table-er">
                    <thead>
                        <tr class="text-light text-uppercase">
                            <th class="col-1">ID</th>
                            <th class="col-3">Titulo</th>
                            <th class="col-2">Subtitulo</th>
                            <th class="col-2">Fecha Creacion</th>
                            <th class="col-2">Seccion</th>
                            <th class="col-4">Imagen</th>
                            <th class="col-1">Accion</th>
                        </tr>
                    </thead>
                    <tbody class="text-light">
                        <?php
                            $query = "SELECT * FROM task ORDER BY id DESC";
                            $result_tasks = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                            <tr>
                                <td class="align-middle"><?php echo $row['Id']; ?></td>
                                <td class="align-middle"><?php echo $row['title']; ?></td>
                                <td class="align-middle"><?php echo $row['subtitle']; ?></td>
                                <td class="align-middle"><?php echo $row['created_at']; ?></td>
                                <td class="align-middle"><?php echo $row['seccion']; ?></td>
                                <td class="img text-center align-middle"><?php echo $row['image']="<img width='auto' height='150px' src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?php echo $row['Id']?>" class="btn btn-outline-success mt-2 mb-1">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="delete_task.php?id=<?php echo $row['Id']?>" data-valor="<?php echo $row['Id']?>" id="idPost<?php echo $row['Id'] ?>" class="getId btn btn-outline-danger mt-2 mb-1">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <a href="previsua.php?id=<?php echo $row['Id']?>" class="btn btn-outline-primary mt-2 mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>     
            </div>
        </div>
    </div>
</div>

    
    <script>var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'NUEVA PUBLICACIÓN' //+ recipient
    //modalBodyInput.value = recipient
    })
      var anchor = document.querySelectorAll(".getId")
        anchor.forEach(function(link) {
        link.addEventListener("click", function(event) {
    // Obtén el valor almacenado en el atributo data-valor de este enlace
        var id = link.getAttribute("data-valor");
    // Aquí puedes realizar acciones adicionales con el valor obtenido 
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
        });
    });
    </script>
    <!--Container Main end-->
    <script src="prueba.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>