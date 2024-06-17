<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    <div class="caja_slider" id="myBody">
      <h1 class="title">Selecciona Seccion</h1>
      <div class="container_slider">
        <div class="container">
          <input type="radio" name="slider" id="item-1" checked>
          <input type="radio" name="slider" id="item-2">
          <input type="radio" name="slider" id="item-3">

          <div class="cards">
            <label  class="card" for="item-1" id="selector-1">
              <img class="imgslide"src="img/logo.jpg">
            </label>
            <label  class="card" for="item-2" id="selector-2">
              <img class="imgslide" src="img/r.jpg">
            </label>
            <label  class="card" for="item-3" id="selector-3">
              <img class="imgslide" src="img/MarioBros.jpg">
            </label>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>