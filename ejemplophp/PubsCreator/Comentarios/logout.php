<?php 
session_start();
$pagina = $_SESSION['pagina'];
unset($_SESSION['auth_user_id']);
unset($_SESSION['authuser_name']);

$_SESSION['status'] = 'Cierre de Sesión Éxitoso';
header('Location: ../Publicaciones/'.$pagina.'.php');
?>