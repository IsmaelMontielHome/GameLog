<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$ruta ="https://definicion.de/wp-content/uploads/2019/07/perfil-de-usuario.png";
$rutafondo ="https://www.htmlcsscolor.com/preview/gallery/151515.png";
$errors = array();
$h= array();

//Si da clic en el botonde registro de usuario
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $h['password'] = "¡Las contraseñas no coinciden!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $h['email'] = "¡El correo electrónico que ha ingresado ya existe!";
    }
    if(count($h) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $user_type = 1;
        $insert_data = "INSERT INTO usertable (name, email, password, code, status, user_type,image,fondo)
                        values('$name', '$email', '$encpass', '$code', '$status', '$user_type','$ruta','$rutafondo')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Codigo de Verificacion de Email";
            $message = "Tu codigo de verificacion es: $code";
            $sender = "From: proyectos0903@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "Hemos enviado un código de verificación a tu correo electrónico - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $h['otp-error'] = "!Error al enviar código!";
            }
        }else{
            $h['db-error'] = "¡Error al insertar datos en la base de datos!";
        }
    }

}
    //Si el usuario hace clic en el botón Enviar código de verificación
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: ../d/Visitante.php'); 
                exit();
            }else{
                $errors['otp-error'] = "¡Error al actualizar codigo!";
            }
        }else{
            $errors['otp-error'] = "¡Has introducido un código incorrecto!";
        }
        
    }
   

   //Si el usuario hace clic en el botón Iniciar sesión
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if(mysqli_num_rows($res) > 0){
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        $fetch_name = $fetch['name'];
        $fetch_user_id = $fetch['id'];
        if(password_verify($password, $fetch_pass)){
            $user_type = $fetch['user_type'];
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            if($status == 'verified'){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['auth_user_id'] = $fetch_user_id;
                $_SESSION['auth_user_name'] = $fetch_name;
                if($user_type == 0){
                    header('location: ../Bienvenida/bienvenida.php'); // redirige a la página de administrador si user_type es 1
                } else {
                    header('location: ../d/Visitante.php'); // redirige a la página de usuario si user_type es 0
                }
            }else{
                if($user_type==0){
                    $info = "Parece que aun no haz verificado tu correo: $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otpad.php');
                }
                else{
                    $info = "Parece que aun no haz verificado tu correo: $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }
        }else{
            $errors['email'] = "¡Correo o contraseña incorrectos!";
        }
    }else{
        $errors['email'] = "¡Parece que aún no eres miembro!<br>De clic en registrarse para continuar.";
    }
}

    //Si el usuario hace clic en el botón Continuar en el formulario Olvidé mi contraseña
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111); 
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Codigo para cambiar contraseña";
                $message = "Tu codigo para cambiar tu contraseña es este: $code";
                $sender = "From: proyectos0903@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Hemos enviado un codigo a tu correo electronico para el cambio de contraseña - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "¡Error al enviar el codigo!";
                }
            }else{
                $errors['db-error'] = "¡Algo salio mal!";
            }
        }else{
            $errors['email'] = "¡Esta dirección de correo electrónico no existe!";
        }
    }

    //Si el usuario, hace clic en el botón Restablecer OTP
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Crea una nueva contraseña que no utilice en ningún otro sitio.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "¡Has introducido un codigo incorrecto!";
        }
    }

    //Si clic en el boton de cmabio de contraseña
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "¡La contraseña no coincide, vuelve a verificarlo!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; 
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = " Tu contraseña a cambiado. Ingresa ahora con tu nueva contraseña.";
                $_SESSION['info'] = $info;
                header('Location: contraseña_cambio.php');
            }else{
                $errors['db-error'] = "No se pudo cambiar tu contraseña";
            }
        }
    }
    
   //Si hace clic en iniciar sesion
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
 //Si da clic en el registro de admi
    if(isset($_POST['signupadmin'])){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "¡Las contraseñas no coinciden!";
        }
        $email_check = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $email_check);
        if(mysqli_num_rows($res) > 0){
            $errors['email'] = "¡El correo electrónico que ha ingresado ya existe!";
        }
        if(count($errors) === 0){
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $user_type = 0;
            $insert_data = "INSERT INTO usertable (name, email, password, code, status, user_type)
                            values('$name', '$email', '$encpass', '$code', '$status', '$user_type')";
            $data_check = mysqli_query($con, $insert_data);
            if($data_check){
                $subject = "Codigo de Verificacion de Email";
                $message = "Tu codigo de verificacion es: $code";
                $sender = "From: proyectos0903@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Hemos enviado un código de verificación a tu correo electrónico - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: user-otpad.php');
                    exit();
                }else{
                    $errors['otp-error'] = "¡Error al enviar código!";
                }
            }else{
                $errors['db-error'] = "¡Error al insertar datos en la base de datos!";
            }
        }
    
    }
//Si el usuario hace clic en el botón Enviar código de verificación
if(isset($_POST['checkad'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otpad']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if($update_res){
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: ../ejemplophp/posts.php');
            exit();
        }else{
            $errors['otp-error'] = "¡Error al actualizar codigo!";
        }
    }else{
        $errors['otp-error'] = "¡Código ingresado incorrecto!. ¡Vuelve a verificarlo!";
    }
}
    


?>