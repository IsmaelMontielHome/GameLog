<?php require_once "../Login/controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
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
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login.php');
}
?>
<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="all,follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="logofinally2.png"/>
    <title>AÑADIR ADMINISTRADOR</title>
    <link rel="stylesheet" href="agregar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/5f897f84ba.js" crossorigin="anonymous"></script>
</head>
<body>              
<div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="agregar.php" method="POST" class="sign-up-form">
                    <h2 class="title">REGISTRO</h2>
                    <p class="text-center text-uppercase">Para nuevo administrador</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert-error">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert-error">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
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
                    <input type="submit" name="signupadmin" class="btn" value="Registrar"/>
                </form>
            </div>
        </div>
        <div>
        <i class="bi bi-arrow-left-circle-fill return" type="button" onclick="atras()"></i>
    <script>
        function atras() {
            window.location.href = "../ejemplophp/posts.php"; 
        }
    </script>
 
    </div>
</body>
</html>

