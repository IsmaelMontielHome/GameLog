<?php
require_once "../Login/controllerUserData.php"; 
include('db.php');
if (isset($_POST['cargarSeleccion'])){
    $id = $_SESSION['idPost'];
    $SelectQuery = "SELECT * FROM task WHERE id = '$id'";
    $SelectQueryRun = mysqli_query($conn, $SelectQuery);
    if(mysqli_num_rows($SelectQueryRun) > 0){
      $row = mysqli_fetch_assoc($SelectQueryRun);
      echo $row['seccion'];
    }
  }
?>