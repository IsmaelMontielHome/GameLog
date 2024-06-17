<?php
session_start();

include('../../db.php');
include('../../../Login/controllerUserData.php');
$pagina = $_SESSION['pagina'];
if(isset($_POST['ingresar'])){
$email = mysqli_real_escape_string($con,$_POST['email']);
$password = mysqli_real_escape_string($con,$_POST['password']);

$login_query = "SELECT * FROM usertable WHERE email = '$email' AND password='$password' LIMIT 1";
$login_query_run = mysqli_query($con, $login_query);

if(mysqli_num_rows($login_query_run) > 0){
    $userdata = mysqli_fetch_array($login_query_run);
    $user_id = $userdata['id'];
    $username = $userdata['fullname'];

    $_SESSION['auth_user_id'] = $user_id;
    $_SESSION['authuser_name'] = $username;

    $_SESSION['status'] = 'Ingreso Exitoso';
    header('Location: ../Publicaciones/'.$pagina.'.php');
}
else{
    $_SESSION['status'] = 'Email o Contraseña Invalidos';
    header('Location: ../Publicaciones/'.$pagina.'.php');
}

}
?>