<?php
include("../db.php");
// Obtener los datos del formulario
// Crear un nombre de archivo único para la imagen

// Mover la imagen cargada al directorio de imágenes

// Crear un nombre de archivo único para la página HTML
if(isset($_POST['eliminar'])){
    $id = $_POST['id'];
    $nombre_pagina = $id.'.php';
    $rutaArchivo = "publicaciones/$nombre_pagina";
    unlink($rutaArchivo);
}

if(isset($_POST['guardar'])){
    $query = "SELECT * FROM task ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
     
    while ($row = mysqli_fetch_assoc($result)) {
     $id = $row['Id'];
     $titulo = $row['title'];
     $subtitulo = $row['subtitle'];
     $user_id = $row['uid'];
     $descripcion = $row['description'];
     $seccion = $row['seccion'];
     $get_data_user = "SELECT * FROM usertable WHERE id = '$user_id' LIMIT 1";
     $get_data_user_run = mysqli_query($conn, $get_data_user);
     $rowUser = mysqli_fetch_assoc($get_data_user_run);
     $userName = $rowUser['name'];
     $creado = $row['created_at'];
     $imagen = base64_encode($row['image']);
     
     $nombre_pagina = $id.'.php';
     // Crear el contenido HTML de la página de publicación
     $contenido_html = '<?php session_start(); $_SESSION["postId"] = '.$id.'?>'.
                       '<html>'.
                       '<head>'.
                       '<link rel="shortcut icon" href="../../../d/img/logo.png">
                       <link rel="stylesheet" href="../../../d/css/header.css">
                       <link rel="stylesheet" href="../../../d/css/footer.css">
                       <link rel="stylesheet" href="../../previsua.css">'.
                       '<title>'.$titulo.'</title>'.
                       '<div id="Visitante"><?php include("../../../d/Parte/headerus2.html");?></div>'.
                       '<br>'.
                       '<br>'.
                       '<br>'.
                       '<br>'.
                       '<body>'.
                       '<section class="caviar-hero-area" id="home">'.
                                    '<!-- Single Slides -->'.
                                    '<div><img style="position: absolute; width: 100%; height: 100%;" src="data:image/jpeg;base64,'.$imagen.'" alt="Imagen de la publicación"></div>'.
                                    '<div class="single-hero-slides bg-img">'.
                                        '<div class="container h-100">'.
                                            '<div class="cont">'.
                                                '<div class="seccion"><p>'.$seccion.'<p></div>'.
                                            '</div>'.
                                            '<div class="row h-100 align-items-center" style="position: absolute; z-index: 5;">'.
                                                '<div class="col-11 col-md-6 col-lg-4">'.
                                                    '<div class="hero-content">'.
                                                        '<h2 style="margin-left: -15%;">'.$titulo.'</h2>'.
                                                        '<!--<p>Estos son los problemas y virtudes de la segunda mitad del juego.</p>-->'.
                                                    '</div>'.
                                                '</div>'.
                                            '</div>'.
                                        '</div>'.
                                    '</div>'.
                            '</section>'.
                            '<section class="caviar-dish-menu mt-5 justify-content-between" id="menu" name="text">'.
                                '<div class="row justify-content-center">'.
                                    '<div class="card bordered-dark mt-3" style="width: 70em; height: auto">'.
                                        '<div class="card-body">'.
                                            '<h2 class="text-center text-uppercase mt-4 sub" style="width: 33em; margin-bottom: 70px">'.$subtitulo.'</h2>'.
                                            '<div class="d-flex justify-content-around">'.
                                                '<p class="text-light" style="font-size: 18px"><i class=" i bi bi-person-fill"></i> Creado por: '.$userName.' </p>'.
                                                '<img>'.
                                                '<p class="text-light" style="font-size: 18px"> <i class="i bi bi-calendar-minus"></i> Fecha: '.$creado.'</p>'.
                                            '</div>'.
                                        '</div>'.
                                    '</div>'.
                                    '<div class="card bordered-dark mt-5" style="width: 70em;">'.
                                        '<div class="card-body text-light" style="font-size: 20px; margin-top: 3%; margin-left: 2%; margin-right: 2%; margin-bottom: 5%">'.
                                        '<p class="text-light" style="font-size: 18px">'.$descripcion.'<p>'.
                                    '</div>'.
                                '</div>'.
                            '<div>'.
                        '</section>'.

                       '</body>'.
                       '<br>'.
                       '<br>'.
                       '<?php include("../Comentarios/index.php");?>'.
                       '<br>'.
                       '<div name = "footer" id = "footer"><?php include("../../../d/Parte/footer.html"); ?></div>'.
                       '</html>';
     
     // Guardar el contenido HTML en un archivo nuevo
     file_put_contents('publicaciones/'.$nombre_pagina, $contenido_html);
    }  
}
?>
