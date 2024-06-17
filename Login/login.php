<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
</script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="httpd:kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>INICIO DE SESIÓN</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="login.php" method="POST" autocomplete="" class="sign-in-form">
                    <h2 class="title">Iniciar sesion</h2>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert-error" id="alertInicio"><i class="bi bi-exclamation-triangle-fill"></i>
                        <?php
                        foreach($errors as $showerror){
                            echo $showerror;
                        }
                        ?>
                        </div>
                        <?php
                        }
                        ?>
                    <div class="input-field">
                        <i class="bi bi-person-circle"></i>
                        <input type="email" name="email" placeholder="Correo" required value="<?php echo $email ?>">
                    </div>
                    <div class="input-field">
                        <i class="bi bi-incognito"></i>
                        <input type="password" name="password" placeholder="Contraseña" required/>
                    </div>
                    <div class="forgetcontra"><a href="cambiar-contraseña.php">¿Olvidaste tu contraseña?</a></div>
                    <input class="btn solid" id="btn_inicio" type="submit" name="login" value="Iniciar sesion">
                    <button onclick="redirectToDefaultPage()" class="btn-2 btn text-uppercase">Regresar</button>
                    <script>
                        function redirectToDefaultPage() {
                            window.location.href = "../d/visitante.php";                        }
                    </script>
                </form>
                <form action="login.php" method="POST" autocomplete="" class="sign-up-form">
                    <h2 class="title">Registro</h2>
                    <?php
                    if(count($h) == 1){
                        ?>
                        <div class="alert-error" id="alertRegistro"><i class="bi bi-envelope-exclamation-fill"></i>
                            <?php
                            foreach($h as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }else {
                        if(count($h) > 1){
                            ?>
                            <div class="alert-error" id="alertRegistro"><i class="bi bi-envelope-exclamation-fill"></i>
                                <?php
                                foreach($h as $showerror){
                                    ?>
                                    <li><?php echo $showerror; ?></li>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <?php
                                    }
                                }
                                ?>
                    <div class="input-field">
                        <i class="bi bi-person-circle"></i>
                        <input type="text" name="name"placeholder="Nombre completo" required value="<?php echo $name ?>"/>
                    </div>
                    <div class="input-field">
                        <i class="bi bi-envelope-at"></i>
                        <input type="email" name="email" placeholder="Correo electronico" required value="<?php echo $email ?>"/>
                    </div>
                    <div class="input-field">
                        <i class="bi bi-incognito"></i>
                        <input type="password" name="password" placeholder="Contraseña" required/>
                    </div>
                    <div class="input-field">
                        <i class="bi bi-incognito"></i>
                        <input type="password" name="cpassword" placeholder="Confirmar Contraseña" required/>
                    </div>
                    <input type="submit" name="signup" class="btn" id="btn_registro" value="Registrate" />
                    <button onclick="redirectToDefaultPage()" class="btn-2 btn text-uppercase">Regresar</button>
                    <script>
                        function redirectToDefaultPage() {
                            window.location.href = "../index.php";                        }
                    </script>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>¡INICIA YA!</h3>
                    <p>
                        Crea tu propia cuenta y goza de los privilegios que te ofrecemos en GameLog.
                    </p>
                    <button class="btn btn2 transparent" id="sign-up-btn">
                        Registrarse
                    </button>
                </div>
                <img src="img/community.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>¿YA TIENES CUENTA?</h3>
                    <p>
                        Inicia sesión y disfruta de las nuevas actualizaciones y mejoras de nuestro blog web.
                        Goza de varidades de posts de tu agrado. Unete!
                    </p>
                    <button class="btn btn2 transparent" id="sign-in-btn">
                        Iniciar Sesion
                    </button>
                </div>
                <img src="img/gif2.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="app.js"></script>
<script>
    // Esperar a que el documento esté listo
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener todos los elementos de alerta
        var alerts = document.querySelectorAll(".alert-error");

        // Para cada elemento de alerta, eliminarlo después de 5 segundos
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.remove();
            }, 5000);
        });
    });
</script>
</script>
</body>
</html>