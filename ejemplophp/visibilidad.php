<?php
include("db.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT visibilidad FROM task WHERE id = $id";
  $result1 = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result1);
  $visibilidad = $row['visibilidad'];
  if($visibilidad == 0)
  {
    $visibilidad = 1;
  }
  else
  {
    $visibilidad = 0;
  }

  $query = "UPDATE task set visibilidad = '$visibilidad' WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: create.php');
}

?>
