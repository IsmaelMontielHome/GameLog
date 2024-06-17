<?php include("../ejemplophp/db.php"); ?>  
<?php 
require_once "../Login/controllerUserData.php"; 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email' AND user_type = 1";
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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NOSOTROS</title>
        <link rel="shortcut icon" href="img/logo.png">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/Acerca_de.css">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet"
                href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
      
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
        <script src="js/scrollreveal.js"></script>
</head>
<body >
    <?php include("Parte/headerus.html")?>
    <div class="wrp">
        <div class="portada"></div>
        <div class="co">
            <br>
            <div class="info">
                <h1>Todos tomamos decisiones en la vida, pero al final nuestras decisiones nos hacen a nosotros</h1>
                <p>Andrew Ryan, Bioshock</p>
            </div>
        </div>
        <div class="curveado">
        </div>
    </div>
    <div>
      <br>
      <br>
      <div class="cont">
        <h1>Creadores</h1>
      </div>
      <br>
      <br>
      <br>
      <br>
    </div>
    <div class="cont">
        <div class="card">
            <div class="lines">
            </div>
            <div class="imgBx">
                <img src="img/isma.jpeg" alt="">
            </div>
            <div class="content">
                <div class="datails">
                    <h2>Ismael Montiel<br><span>Tampico Tamaulipas</span></h2>
                    <div class="data">
                        <h3>34<br><span>Posts</span></h3>
                        <h3>19<br><span>Años</span></h3>
                        <h3>Programador<br><span>Rol</span></h3>
                    </div>
                    <div class="actionBtn">
                        <a href="https://web.facebook.com/alejandro.montieltorres.7"><button class="facebook">Facebook</button></a>
                        <a href="https://www.instagram.com/alejandromontieltorres/"><button class="instagram">Instagram</button></a>
                        <a href="https://github.com/IsmaelMontiel710"><button class="Github">GitHub</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="lines">
            </div>
            <div class="imgBx">
                <img src="img/max.jpeg" alt="">
            </div>
            <div class="content">
                <div class="datails">
                    <h2>Maximiliano Mendoza<br><span>Colima Col.</span></h2>
                    <div class="data">
                        <h3>34<br><span>Posts</span></h3>
                        <h3>21<br><span>Años</span></h3>
                        <h3>Programador<br><span>Rol</span></h3>
                    </div>
                    <div class="actionBtn">
                        <a href="https://web.facebook.com/maxalexander.mendozalopez"><button class="facebook">Facebook</button></a>
                        <a href="https://www.instagram.com/sethiova/"><button class="instagram">Instagram</button></a>
                        <a href="https://github.com/sethiova"><button class="Github">GitHub</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="lines">
            </div>
            <div class="imgBx">
                <img src="img/gael.jpeg" alt="">
            </div>
            <div class="content">
                <div class="datails">
                    <h2>Gael Valencia<br><span>Guadalajara Jal.</span></h2>
                    <div class="data">
                        <h3>34<br><span>Posts</span></h3>
                        <h3>18<br><span>Años</span></h3>
                        <h3>Programador<br><span>Rol</span></h3>
                    </div>
                    <div class="actionBtn">
                        <a href="https://web.facebook.com/jorgegael.valenciacolima/"><button class="facebook">Facebook</button></a>
                        <a href="https://www.instagram.com/gael_jor22/"><button class="instagram">Instagram</button></a>
                        <a href="https://github.com/GaelValencia"><button class="Github">GitHub</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <br>
        <br>


    </div>
    <div class="cont">
        
        <div class="card">
            <div class="lines">
            </div>
            <div class="imgBx">
                <img src="img/angel.jpeg" alt="">
            </div>
            <div class="content">
                <div class="datails">
                    <h2>Angel Diaz<br><span>Manzanillo Col.</span></h2>
                    <div class="data">
                        <h3>34<br><span>Posts</span></h3>
                        <h3>18<br><span>Años</span></h3>
                        <h3>Programador<br><span>Rol</span></h3>
                    </div>
                    <div class="actionBtn">
                        <a href="https://web.facebook.com/ANGELELCH123"><button class="facebook">Facebook</button></a>
                        <a href=""><button class="instagram">Instagram</button></a>
                        <a href="https://github.com/AngelDiaz591"><button class="Github">GitHub</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="lines">
            </div>
            <div class="imgBx">
                <img src="img/mari.jpeg" alt="">
            </div>
            <div class="content">
                <div class="datails">
                    <h2>Mariana Pegueros<br><span>Estado de Mexico</span></h2>
                    <div class="data">
                        <h3>34<br><span>Posts</span></h3>
                        <h3>19<br><span>Años</span></h3>
                        <h3>Programador<br><span>Rol</span></h3>
                    </div>
                    <div class="actionBtn">
                        <a href="https://web.facebook.com/profile.php?id=100005581575012"><button class="facebook">Facebook</button></a>
                        <a href="https://www.instagram.com/chachitabeans/"><button class="instagram">Instagram</button></a>
                        <a href="https://github.com/MeganPegueros"><button class="Github">GitHub</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="lines">
            </div>
            <div class="imgBx">
                <img src="img/alan.jpeg" alt="">
            </div>
            <div class="content">
                <div class="datails">
                    <h2>Alan San Millan<br><span>Jocotepec Jal.</span></h2>
                    <div class="data">
                        <h3>34<br><span>Posts</span></h3>
                        <h3>18<br><span>Años</span></h3>
                        <h3>Programador<br><span>Rol</span></h3>
                    </div>
                    <div class="actionBtn">
                        <a href="https://web.facebook.com/profile.php?id=100016180260162"><button class="facebook">Facebook</button></a>
                        <a href="https://www.instagram.com/alansanmillan/"><button class="instagram">Instagram</button></a>
                        <a href="https://github.com/Alan-San-Millan"><button class="Github">GitHub</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div name="footer"id="footer"><?php include("Parte/footerus2.html")?></div>
    <script type="text/javascript" src="js/header.js"></script>
    <script  src="js/index.js"></script>
</body>
</html>