<?php include("ejemplophp/db.php"); ?>  
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Visitante</title>
        <link rel="shortcut icon" href="d/img/logo.png">
        <link rel="stylesheet" href="d/css/header.css">
        <link rel="stylesheet" href="d/css/footer.css">
        <link rel="stylesheet" href="d/css/visitante.css">
            <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet"
                href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
      
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
        <script src="d/js/scrollreveal.js"></script>
</head>
<body >
    <div id="Visitante"><?php include("d/Parte/header.html")?></div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        <div class="contenedor-publicacionesinicio na"id="#IniciaSesion">
            <div class="caja_inicio">
                <?php
                $query = "SELECT * FROM task ORDER BY id DESC LIMIT 0,1";
                $result_tasks = mysqli_query($conn, $query);    
                $row = mysqli_fetch_assoc($result_tasks) ;
                $id = $row['Id'];

                ?>
                <div class="imageninicio">
                    <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
                </div>
                <div class="informacioninicio">
                    <br>
                    <br>
                    <br>
                    <h1 class="tituloinicio"><?php echo $row['title']; ?></h1>
                    <h2 class="subtituloinicio"><?php echo $row['subtitle']; ?></h2>
                    <div class="detallesinicio">
                        <i class="ri-playstation-lineinicio"></i>
                        <span class="seccioninicio"><?php echo $row['seccion']; ?></span>
                        <br>
                        <br>
                        <a  href="#IniciaSesion"  class="leer-mas modalBtn">Leer más...</a>
                    </div>
                </div>
                <div class="fecha-creacioninicio">
                    <div>
                        <br>
                        <br>
                    </div>
                    <span class="fecha-creacioninicio"><?php echo $row['created_at']; ?></span>
                </div>
            </div>
        </div>
    <br>
    <div class="cont ri"><h1>La seccion que gustes es facil</h1></div>
    <div class="cont ri">
        <div class="caja " id="caja1">
            <a href="#IniciaSesion" class="modalBtn"><img src="d/img/xbox.png" alt="Imagen"></a>
        </div>
        <div class="caja2 " id="caja2">
            <a href="#IniciaSesion"class="modalBtn"><img src="d/img/nintendo.png" alt="Imagen"></a>
        </div>
        <div class="caja3 " id="caja3">
            <a href="#IniciaSesion"class="modalBtn"><img src="d/img/play.jpg" alt="Imagen"></a>
        </div>
        <div class="caja4 " id="caja4">
            <a href="#IniciaSesion"class="modalBtn"><img src="d/img/pc 1.jpg" alt="Imagen"></a>
        </div>
    </div>
    <br>
    <div class="modal">
        <div class="modal-content">
            <span class="closeIcon"><i class="ri-close-line"></i></span>
            <div class="modal-body">
                <span class="icon"><i class="ri-user-unfollow-line"></i></span>
                <div class="right-items">
                    <h1>¡Lo siento!</h1>
                    <p>Debes de Iniciar Sesion para la Visualización</p>
                    <a href="Login/login.php" id="okBtn">Inicia Sesion</a>
                </div>
            </div>
        </div>
    </div>
    <div class="contenedor-publicaciones">
        <div class="caja-publicacion">
            
            <?php
            $query = "SELECT * FROM task WHERE seccion='Xbox' ORDER BY id DESC ";
            $result_tasks = mysqli_query($conn, $query);    
            $row = mysqli_fetch_assoc($result_tasks) 
            ?>
            <div class="imagen">
                <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion2">
                <h1 class="titulo"><?php echo $row['title']; ?></h1>
                <h2 class="subtitulo"><?php echo $row['subtitle']; ?></h2>
                <div class="detalles">
                    <i class="ri-xbox-fill"></i>
                    <span class="seccion"><?php echo $row['seccion']; ?></span>
                    <br>
                    <br>
                    <a  href="#IniciaSesion"  class="leer-mas modalBtn">Leer más...</a>
                </div>
            </div>

            <div class="fecha-creacion">
                <div>
                    <br>
                    <br>
                </div>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
            </div>
        </div>
        <div class="caja-publicacion">
            
            <?php
            $query = "SELECT * FROM task WHERE seccion='Pc' ORDER BY id DESC ";
            $result_tasks = mysqli_query($conn, $query);    
            $row = mysqli_fetch_assoc($result_tasks) 
            ?>
            <div class="imagen">
                <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion pe">
                <h1 class="titulo"><?php echo $row['title']; ?></h1>
                <h2 class="subtitulo"><?php echo $row['subtitle']; ?></h2>
                <div class="detalles">
                    <i  class="ri-computer-line"></i>
                    <span class="seccion"><?php echo $row['seccion']; ?></span>
                    <br>
                    <br>
                    <a href="#IniciaSesion"   class="leer-mas modalBtn">Leer más...</a>
                </div>
            </div>
            <div class="fecha-creacion">
                <div>
                    <br>
                    <br>
                </div>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
            </div>
        </div>
    </div>
    <br>
    <div class="contenedor-publicaciones">
        <div class="caja-publicacion">
            
            <?php
            $query = "SELECT * FROM task WHERE seccion='Playstation' ORDER BY id DESC";
            $result_tasks = mysqli_query($conn, $query);    
            $row = mysqli_fetch_assoc($result_tasks) 
            ?>
            <div class="imagen">
                <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion3">
                <h1 class="titulo"><?php echo $row['title']; ?></h1>
                <h2 class="subtitulo"><?php echo $row['subtitle']; ?></h2>
                <div class="detalles">
                    <i class="ri-playstation-line"></i>
                    <span class="seccion"><?php echo $row['seccion']; ?></span>
                    <br>
                    <br>
                    <a href="#IniciaSesion"   class="leer-mas modalBtn">Leer más...</a>
                </div>
            </div>
            <div class="fecha-creacion">
                <div>
                    <br>
                    <br>
                </div>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
            </div>
        </div>
        <div class="caja-publicacion">
            
            <?php
            $query = "SELECT * FROM task WHERE seccion='Nintendo' ORDER BY id DESC ";
            $result_tasks = mysqli_query($conn, $query);    
            $row = mysqli_fetch_assoc($result_tasks) 
            ?>
            <div class="imagen">
                <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion4">
                <h1 class="titulo"><?php echo $row['title']; ?></h1>
                <h2 class="subtitulo"><?php echo $row['subtitle']; ?></h2>
                <div class="detalles">
                    <i class="ri-switch-line"></i>
                    <span class="seccion"><?php echo $row['seccion']; ?></span>
                    <br>
                    <br>
                    <a href="#IniciaSesion"   class="leer-mas modalBtn">Leer más...</a>
                </div>
            </div>
            <div class="fecha-creacion">
                <div>
                    <br>
                    <br>
                </div>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
            </div>
        </div>
    </div>
    <div class="contenedor-publicaciones">
        <div class="caja-publicacion">
            <?php
            $query = "SELECT * FROM task WHERE seccion='Playstation' ORDER BY id DESC LIMIT 2,1";
            $result_tasks = mysqli_query($conn, $query);    
            $row = mysqli_fetch_assoc($result_tasks) 
            ?>
            <div class="imagen">
                <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion3">
                <h1 class="titulo"><?php echo $row['title']; ?></h1>
                <h2 class="subtitulo"><?php echo $row['subtitle']; ?></h2>
                <div class="detalles">
                    <i class="ri-playstation-line"></i>
                    <span class="seccion"><?php echo $row['seccion']; ?></span>
                    <br>
                    <br>
                    <a href="#IniciaSesion"   class="leer-mas modalBtn">Leer más...</a>
                </div>
            </div>
            <div class="fecha-creacion">
                <div>
                    <br>
                    <br>
                </div>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
            </div>
        </div>
        <div class="caja-publicacion">
            
            <?php
            $query = "SELECT * FROM task WHERE seccion='Xbox'ORDER BY id DESC LIMIT 6,1";
            $result_tasks = mysqli_query($conn, $query);    
            $row = mysqli_fetch_assoc($result_tasks) 
            ?>
            <div class="imagen">
                <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
            </div>
            <div class="informacion2">
                <h1 class="titulo"><?php echo $row['title']; ?></h1>
                <h2 class="subtitulo"><?php echo $row['subtitle']; ?></h2>
                <div class="detalles">
                    <i class="ri-xbox-fill"></i>
                    <span class="seccion"><?php echo $row['seccion']; ?></span>
                    <br>
                    <br>
                    <a  href="#IniciaSesion"  class="leer-mas modalBtn">Leer más...</a>
                </div>
            </div>

            <div class="fecha-creacion">
                <div>
                    <br>
                    <br>
                </div>
                <span class="fecha-creacion"><?php echo $row['created_at']; ?></span>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="cont">
        <h1 class="h1slider">ULTIMA ACTUALIZACIÓN</h1>
    </div>
    <br>
    <br>
    <br>
    <br>
    <section>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                    $query = "SELECT * FROM task  ORDER BY id DESC LIMIT 10";
                    $result_tasks = mysqli_query($conn, $query);    
                    while($row = mysqli_fetch_assoc($result_tasks)) { 
                            
                ?>
                <div class="swiper-slide">
                    <div class="imgBoxslider">
                        <?php echo $row['image']="<img  src='data:image/jpg;base64,".base64_encode($row['image'])."'>";?>
                    </div>
                    <div class="contenidslider">
                        <h2><?php echo $row['title']; ?></h2>
                        <p><?php echo $row['subtitle']; ?></p>
                        <a  href="#IniciaSesion"  class=" modalBtn">Leer más...</a>
                    </div>
                </div>
                <?php
                    } 
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>  
    <br>
    <div name="footer"id="footer"><?php include("d/Parte/footerus.html")?></div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        });
    </script>
    <script type="d/text/javascript" src="js/header.js"></script>
    <script  src="d/js/caja_seccionv.js"></script>
    <script  src="d/js/aviso.js"></script>
    <script  src="d/js/index.js"></script>
</body>
</html>