<?php 
require_once "../Login/controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email' AND user_type = 0";
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
            header('Location: login.php');
        }
    }else{
        header('Location: user-otp.php');
    }
}else{
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="modal.css">
<body>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog-fullscreen">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title text-uppercase">VISUALIZACIÓN DEL VISITANTE</h4>
            <button type="button" class="close" data-dismiss="modal" onclick="closemodal()">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <iframe src="../d/visitante.php" style="width:100%; height:630px;"></iframe>
            </div>
            <!-- Modal footer 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closemodal()">Close</button>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            -->
        </div>
        </div>
    </div>
</body>
</html>
<script>
function closemodal() {
  window.location.href = "../ejemplophp/posts.php";
}
$(document).ready(function(){
    $('#myModal').modal({backdrop: 'static', keyboard: false});  
});
</script>