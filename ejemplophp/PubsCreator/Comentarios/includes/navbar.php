<!-- Modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inicio de Sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<form action="../Comentarios/logincode.php" method="POST">
      <div class="modal-body">
       <div class = "form-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Ingresa tu Email">
       </div>
       <div class = "form-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña">
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
        <button type="submit" name="ingresar" class="btn btn-primary">Ingresar</button>
      </div>
</form>
    </div>
  </div>
</div>
</script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">GameLog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span lass="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <?php
            if(!isset($_SESSION['auth_user_id']))
            { ?>
            <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#LoginModal">Ingresar</a>
            <?php }
            else
            { ?>
             <a class="nav-link active" href="../Comentarios/logout.php">Cerrar Sesión</a>
            <?php }
            ?>
          
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#"><?php if(isset($_SESSION['authuser_name'])){echo $_SESSION['authuser_name'];}?></a>
        </li>
    </div>
  </div>
</nav>