<?php
session_start();
include('db.php');

if (isset($_POST['save_task'])) {
  $userid = $_SESSION['auth_user_id'];
  $title= $_POST['title'];
  $titleProcesado = mysqli_real_escape_string($conn, $title);
  $subtitle= $_POST['subtitle'];
  $subtitleProcesado = mysqli_real_escape_string($conn, $subtitle);
  $description = $_POST['description'];
  $descriptionProcesado = mysqli_real_escape_string($conn, $description);
  $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
  $seccion = $_POST['opcion'];
  $visibilidad = 0;
  $query = "INSERT INTO task(uid, title, subtitle, description, image, seccion, visibilidad) VALUES ('$userid','$titleProcesado','$subtitleProcesado', '$descriptionProcesado','$image', '$seccion', '$visibilidad')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: Vision.php');

}

?>
