<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login.php" method="POST" autocomplete="">
                    <h2 class="text-center text-uppercase">Inicio de Sesion</h2>
                    <p class="text-center">Inicia sesion con tu correo electronico y tu contraseña.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Correo Electronico" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="cambiar-contraseña.php">Olvidaste tu contraseña?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Iniciar sesión">
                    </div>
                    <div class="link login-link text-center">No eres miembro? <a href="registro.php">Registrate ahora</a></div>
                    <button onclick="redirectToDefaultPage()" class="btn-2 btn text-uppercase">Regresar</button>
                    <script>
                        function redirectToDefaultPage() {
                            window.location.href = "../d/visitante.php";                        }
                    </script>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>