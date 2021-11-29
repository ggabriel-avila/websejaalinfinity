<?php

require 'core/configuracion/configuracion.php';
require 'core/seguridad/usuarioAdministrador.php';

use configuracion\general;
if(usuarioAdministrador::estaLogeado()){
  header('location: indexAdministrador');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Sejaal Infinity</title>
  <link rel="icon" type="image/svg+xml" href="media/logo.svg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,600;0,800;1,600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/estilos.css" rel="stylesheet" />
  <input type="hidden" value="<?= general::constante('url') ?>/core/login/api/iniciarSesion" id="apiLogin">
</head>

<body id="page-top">
  <header>
    <div class="d-flex justify-content-end" style="background-color:black;">
      <div class="RedesHeader d-none d-lg-block">
        <a title="Discord" href="https://discord.com/invite/EYDAWQErKW"><img src="media/discord.svg" alt="discord logo"></a>
        <a title="Instagram" href="https://www.instagram.com/sejaalinfinity/"><img src="media/instagram.svg" alt="Instagram logo"></a>
        <a title="Twitter" href="https://twitter.com/SejaalInfinity"><img src="media/twitter.svg" alt="twitter logo"></a>
        <a title="Twitch" href="https://twitch.tv/"><img src="media/twitch.svg" alt="twitch logo"></a>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light py-3" id="mainNav">
      <div class="container">
        <a class="logoHeader" title="sejaal" href="#page-top"><img src="media/logo.svg" alt="Logo Sejaal"></a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto my-2 my-lg-0">
            <li class="nav-item"><a class="nav-link" href="#page-top">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#QuienesSomosSeccion">Quienes somos</a></li>
            <li class="nav-item"><a class="nav-link" href="#AnunciosSeccion">Anuncios</a></li>
            <li class="nav-item"><a class="nav-link" href="https://docs.google.com/forms/d/e/1FAIpQLSfm9WbmjPkamHD976TAUQh9BTUwpIKywv_b8ocufR78GfaLnA/viewform" target="_blank">Formulario</a></li>
            <li class="nav-item"><a class="nav-link" href="#infoBecasSeccion">Info Becas</a></li>
            <li class="nav-item d-sm-block d-md-none"><a class="nav-link" href="#tablaGeneralSeccion">Ranking y tablas</a></li>
            <li class="nav-item dropdown d-none d-lg-block">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ranking</a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="#tablaGeneralSeccion">Tabla general</a></li>
                <li><a class="dropdown-item" href="#gruposSeccion">Grupos de becados</a></li>
              </ul>
            </li>
            <div class="logoHeaderMobile d-sm-block d-md-none">
              <a title="Facebook" href="https://facebook.com/"><img src="media/facebook.svg" alt="facebook logo"></a>
              <a title="Instagram" href="https://www.instagram.com/sejaalinfinity/"><img src="media/instagram.svg" alt="Instagram logo"></a>
              <a title="Twitter" href="https://twitter.com/SejaalInfinity"><img src="media/twitter.svg" alt="twitter logo"></a>
              <a title="Discord" href="https://discord.com/invite/EYDAWQErKW"><img src="media/discord.svg" alt="discord logo"></a>
            </div>
          </ul>
        </div>

      </div>

    </nav>
  </header>

  <section class="page-section" id="QuienesSomosSeccion">
    <div id="login">
      <div class="container px-4 px-lg-5">
        <h1 class="text-start mt-0">Login</h1>
        <div class="row gx-4 gx-lg-5">
          <div class="mb-3">
            <img src="media/usuario.svg" alt="usuario ux" style="width: 1em;">
            <label for="exampleInputEmail1" class="labelLogin">Usuario</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="usuario" v-model="usuario">
          </div>
          <div class="mb-3">
            <img src="media/contra.svg" alt="contrasenia ux" style="width: 1em;">
            <label for="exampleInputPassword1" class="labelLogin">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1"  v-model="clave">
          </div>
          <button type="button" class="btn btn-primary" @click="iniciarSesion">Ingresar</button>
        </div>
      </div>
    </div>
  </section>
  <footer class="cpy-5">

    <div class="contactoFooter">
      <h1>Contacto</h1>
      <h2>Contacto@sejaalinfinity.com</h2>
      <h2>Copyright © 2021 Sejaal Infinity</h2>
    </div>
    <div class="logoRedesHeader container" style="display:flex; justify-content: center; margin-top:1.5em;">
      <a title="Discord" href="https://discord.com/invite/EYDAWQErKW"><img src="media/discord.svg" alt="discord logo"></a>
      <a title="Instagram" href="https://www.instagram.com/sejaalinfinity/"><img src="media/instagram.svg" alt="Instagram logo"></a>
      <a title="Twitter" href="https://twitter.com/SejaalInfinity"><img src="media/twitter.svg" alt="twitter logo"></a>
      <a title="Twitch" href="https://twitch.tv/"><img src="media/twitch.svg" alt="twitch logo"></a>
    </div>
    <div class="text-center small">
      <h3>Diseñado por Gabriel Avila 2021</h3>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js" integrity="sha512-NuUIe6TWdEivPTcxnihx2e6r2xQFEFPrJfpdZWoBwZF6G51Rphcf5r/1ZU/ytj4lyHwLd/YGMix4a5LqAN15XA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="<?= general::constante('url') ?>/js/herramientas.js"></script>
  <script src="<?= general::constante('url') ?>/js/login/iniciarSesion.js"></script>
</body>

</html>