<?php
include 'core/configuracion/baseDeDatos.php';

use configuracion\general;
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
</head>

<body id="page-top">
  <header>
    <div class="d-flex justify-content-end" style="background-color:black;">
      <div class="RedesHeader d-none d-lg-block">
        <?php
        $conexion = new baseDeDatos();
        $conexion->conectar();
        $sql = "SELECT * FROM enlaces";
        $datosBD = $conexion->conexion->query($sql);
        $datos = $datosBD->fetch_all(MYSQLI_ASSOC);
        $conexion->desconectar();
        foreach ($datos as $dato) {
          echo "<a href='$dato[enlace]'><img src='$dato[imagen]' alt='logo'></a>";
        }
        ?>
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
            <li class="nav-item"><a class="nav-link" href="<?= general::constante('url') ?>/ranking.php">Ranking y tablas</a></li>
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
  <section>
    <img src="media/baner.jpg" alt="sejaal" style="width: 100%">
  </section>
  <section class="page-section" id="QuienesSomosSeccion">
    <div class="container px-4 px-lg-5">
      <h1 class="text-start mt-0">¿Quienes somos?</h1>
      <div class="row gx-4 gx-lg-5">
        <img class="col-lg-6 col-12" src="media/logo-extendido.svg" alt="Logo Sejaal Infinity">
        <div class="col-lg-6 col-12">
          <p>Somos una organización con el fin de ayudar a personas económicamente dándoles las herramientas para adentrarse en el mundo NFT, concretamente Axie Infinity. En este, contamos con una Academia de becas, donde primordialmente buscamos el desarrollo de nuestros becados y de la organización, expandiéndonos para llegar cada vez a más gente.</p>
        </div>
      </div>
      <div class="flex-center">
        <button> <a href="https://docs.google.com/forms/d/e/1FAIpQLSfm9WbmjPkamHD976TAUQh9BTUwpIKywv_b8ocufR78GfaLnA/viewform" target="_blank">Completá el formulario</a> </button>
      </div>
    </div>
  </section>
  <section class="page-section" id="AnunciosSeccion">
    <div class="container px-4 px-lg-5">
      <h1 class="text-start mt-0">Anuncios</h1>
      <div class="row gx-4 gx-lg-5-an">
        <?php
        $conexion = new baseDeDatos();
        $conexion->conectar();
        $sql = "SELECT * FROM anuncios ORDER BY id DESC";
        $datosBD = $conexion->conexion->query($sql);
        $datos = $datosBD->fetch_all(MYSQLI_ASSOC);
        $conexion->desconectar();
        $contador = 1;
        foreach ($datos as $dato) :
          if ($contador <= 2) :
            $contador++;
        ?>
            <div class="col-lg-6 col-12 card">
              <div class="anuncios ">
                <div class="card-body">
                  <h3><?= $dato['titulo'] ?></h3>
                  <h4> <span class="badge bg-light text-dark">NUEVO</span> <?= $dato['fecha'] ?></h4>
                  <p class="card-text"><?= $dato['descripcion'] ?></p>
                </div>
              </div>
            </div>
        <?php
          endif;
        endforeach;
        ?>
      </div>
      <div class="collapse" id="collapseExample">
        <div class="row gx-4 gx-lg-5-an">
          <?php
          $conexion = new baseDeDatos();
          $conexion->conectar();
          $sql = "SELECT * FROM anuncios ORDER BY id DESC";
          $datosBD = $conexion->conexion->query($sql);
          $datos = $datosBD->fetch_all(MYSQLI_ASSOC);
          $conexion->desconectar();
          $contador = 0;
          if (count($datos) > 2) :
            foreach ($datos as $dato) :
              $contador++;
              if ($contador >= 3) :
          ?>
                <div class="col-lg-6 col-12 card">
                  <div class="anuncios ">
                    <div class="card-body">
                      <h3><?= $dato['titulo'] ?></h3>
                      <h4> <span class="badge bg-light text-dark">NUEVO</span> <?= $dato['fecha'] ?></h4>
                      <p class="card-text"><?= $dato['descripcion'] ?></p>
                    </div>
                  </div>
                </div>
            <?php
              endif;
            endforeach;
          else :
            ?>
            <div class="card card-body ">
              <p class="flex-center">No hay más anuncios</p>
            </div>
          <?php
          endif;
          ?>
        </div>
      </div>
      <div class="flex-center">
        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="vermas1" onclick="expandir(this)">Ver más</button>
      </div>
    </div>
  </section>
  <section class="page-section" id="infoBecasSeccion">
    <div class="container px-4 px-lg-5">
      <h1 class="text-start mt-0">Información de becas</h1>
      <div class="row gx-4 gx-lg-5">
        <h2>-SLP mínimos y porcentaje</h2>
        <div class="col-lg-6 col-12">
          <p><b>Primer mes:</b> El becado tendrá que hacer un mínimo de 3630 SLP, este número es menor que el de los otros meses, ya que los primeros días el becado deberá gastar sus energías para subir de nivel sus axies lo que no le permitirá ganar SLP jugando arena. Este número se obtiene al sumar 75 SLP diarios la primera semana + 135 SLP diarios los otros días restantes del mes. Es decir, el becado podrá jugar la primera semana las 20 energías diarias en modo PvE y a partir de ahí deberá gastar sus energías jugando PvP para poder llegar a los 135 SLP diarios (en promedio). <b>De estos 3630 SLP, el 30% serán para el becado y el 70% para Sejaal Infinity, todos los SLP excedentes a este número, le corresponderán 60% al becado y 40% a Sejaal Infinity. </b> </p>
        </div>
        <div class="col-lg-6 col-12">
          <p><b>Segundo mes en adelante: </b> El becado tendrá que hacer un mínimo de 4050 SLP, este número se obtiene al hacer un promedio de 135 SLP diarios. <b>De estos 4050 SLP el 40% serán para el becado y el 60% para Sejaal Infinity, todos los SLP excedentes a este número, le corresponderán 60% al becado y 40% a Sejaal Infinity </b> </p>
        </div>
      </div>
      <div class="row row-grafico  gx-4 gx-lg-5 ">
        <div class="col-lg-6-img col-12">
          <img src="media/primermes-grafico.svg" alt=" Primer mes ganancia sejaal infinity">
        </div>
        <div class="col-lg-6-img col-12">
          <img src="media/segundomes-grafico.svg" alt=" Segundo mes ganancia sejaal infinity">
        </div>
      </div>
      <div class="collapse" id="collapseExample">
        <div class="row gx-4 gx-lg-5">
          <h2>-Grupos</h2>
          <div class="col-lg-6 col-12">
            <ul>
              <li>Para incentivar la competitividad y el desarrollo de nuestros becados, contamos con un sistema de grupos dinámicos mensuales.</li>
              <li>A lo largo de cada mes los becados competirán entre ellos por conseguir un 10% extra de SLP sobre su paga.</li>
            </ul>
          </div>
          <div class="col-lg-6 col-12">
            <ul>
              <li>El día 17 de cada mes a las 00:00hs UTC se reiniciará la competencia y se darán a conocer los ganadores, quedará primero el becado que más copas haya alcanzado en su grupo.</li>
              <li>El día 18 de cada mes se actualizarán y anunciarán los grupos. En la sección *ranking* se pueden visualizar los grupos actuales y la tabla general de copas.</li>
            </ul>
          </div>
        </div>

        <div class="row gx-4 gx-lg-5">
          <h2>-Pagos <img src="media/slp.png" alt="SLP transparente" style="width: 2.5em;"></h2>
          <div class="col-lg-6 col-12">
            <ul>
              <li>El pago se realiza en SLP, enviándose directamente a la cuenta de Binance o Ronin a preferencia de cada becado.</li>
            </ul>
          </div>
          <div class="col-lg-6 col-12">
            <ul>
              <li>Los pagos son de manera mensual y cuando el becado ingrese se le informará específicamente en que día recibirá sus SLP.</li>
            </ul>
          </div>
        </div>

        <div class="row gx-4 gx-lg-5">
          <h2>-Renunciar a la beca</h2>
          <div class="col-lg-6 col-12">
            <ul>
              <li>Cada becado puede renunciar a su beca en cualquier momento, pero en caso de no completar el mes y que la renuncia sea en el transcurso de los 30 días, no se efectuará ningún pago </li>
            </ul>
          </div>
          <div class="col-lg-6 col-12">
            <ul>
              <li>Se agradece el aviso anticipado de la salida, así es tenido en cuenta para que Sejaal gestione la entrada de un nuevo becado.</li>
            </ul>
          </div>
        </div>
        <div class="row gx-4 gx-lg-5">
          <h2>-Ban de cuentas</h2>
          <div class="col-lg-6 col-12">
            <ul>
              <li>En el caso de que un becado cometa errores y se le banee la cuenta, este deberá pagar los axies que se le habían proporcionado al precio de ese momento en el mercado.</li>
            </ul>
          </div>
          <div class="col-lg-6 col-12">
            <ul>
              <li>Los motivos de ban pueden ser:</li>
              <ul>
                <li>Multicuentas en un mismo dispositivo.</li>
                <li>Tener más de dos cuentas abiertas en la misma IP de Wi-Fi.</li>
                <li>Todo programa de terceros no autorizados (Escritorios remotos, emuladores, etc)</li>
                <li>Cambiar el horario del dispositivo para beneficio propio.</li>
              </ul>
            </ul>
          </div>
        </div>
      </div>
      <div class="flex-center">
        <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" id="vermas2" onclick="expandir(this)" aria-controls="collapseExample">Ver más</button>
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
      <?php
      $conexion = new baseDeDatos();
      $conexion->conectar();
      $sql = "SELECT * FROM enlaces";
      $datosBD = $conexion->conexion->query($sql);
      $datos = $datosBD->fetch_all(MYSQLI_ASSOC);
      $conexion->desconectar();
      foreach ($datos as $dato) {
        echo "<a href='$dato[enlace]'><img src='$dato[imagen]' alt='logo'></a>";
      }
      ?>
    </div>
    <div class="text-center small">
      <h3>Diseñado por Gabriel Avila 2021</h3>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
  <script src="<?= general::constante('url') ?>/js/scripts.js"></script>
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
  <script>
    function expandir(button) {
      if (button.textContent == 'Ver más') {
        document.getElementById(button.id).textContent = 'Ver menos';
      } else if (button.textContent == 'Ver menos') {
        document.getElementById(button.id).textContent = 'Ver más';
      }
    }
  </script>
</body>

</html>