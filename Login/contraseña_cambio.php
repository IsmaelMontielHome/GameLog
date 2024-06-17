<?php require_once "controllerUserData.php"; ?>
<?php
if ($_SESSION['info'] == false) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cambiado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <?php
                if (isset($_SESSION['info'])) {
                    ?>
                    <div class="alert-success"><i class="bi bi-check-circle-fill"></i>
                        <?php echo $_SESSION['info']; ?>
                    </div>
                    <?php
                }
                ?>
                <form action="login.php" method="POST">
                    <div class="form-group" id="btn">
                        <input class="form-control button text-uppercase" type="submit" name="ingresa ahora" value="Ingresar ahora">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>