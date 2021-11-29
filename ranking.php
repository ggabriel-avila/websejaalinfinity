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
                    foreach($datos as $dato){
                        echo "<a title='Discord' href='$dato[enlace]'><img src='$dato[imagen]' alt='logo'></a>";
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
                        <li class="nav-item"><a class="nav-link" href="<?= general::constante('url') ?>/#page-top">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= general::constante('url') ?>/#QuienesSomosSeccion">Quienes somos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= general::constante('url') ?>/#AnunciosSeccion">Anuncios</a></li>
                        <li class="nav-item"><a class="nav-link" href="https://docs.google.com/forms/d/e/1FAIpQLSfm9WbmjPkamHD976TAUQh9BTUwpIKywv_b8ocufR78GfaLnA/viewform" target="_blank">Formulario</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= general::constante('url') ?>/#infoBecasSeccion">Info Becas</a></li>
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
    <section class="page-section" id="tablaGeneralSeccion">
        <div class="container px-4 px-lg-5 ">
            <h1 class="text-start mt-0">Ranking</h1>
            <div class="row gx-4 gx-lg-5 tablaMobile">
                <h2 class="d-flex justify-content-center">Tabla general</h2>
                <div class="col-12 d-flex justify-content-center">
                    <table class="table">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col" style="border-top-left-radius: 1em; justify-content: center;">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Promedio de SLP </th>
                                <th scope="col">SLP por victoria</th>
                                <th scope="col" style="border-top-right-radius: 1em;">
                                    <div ><img style="width: 2em; margin-right: 0;" src="media/copa.svg" alt="copa SLP"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conexion = new baseDeDatos();
                            $sql = "SELECT * FROM jugadores ORDER BY cantidad_spl_victoria DESC";
                            $conexion->conectar();
                            $datos = $conexion->conexion->query($sql);
                            $datos = $datos->fetch_all(MYSQLI_ASSOC);
                            $conexion->desconectar();
                            $contador = 0;
                            foreach ($datos as $dato) {
                                $contador = $contador + 1;
                                echo "
                                    <tr>
                                        <th scope='row'>$contador</th>
                                        <td>$dato[nombre]</td>
                                        <td>$dato[promedio_spl]</td>
                                        <td>$dato[cantidad_spl_victoria]</td>
                                        <td>$dato[cantidad_copas]</td>
                                    </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex-center" style="padding-top:0;">
                <p style="font-size: 0.8em;"> Las tablas se actualizarán en <b style="color:red;">X</b> segundos. </p>
            </div>
        </div>
    </section>
    <section class="page-section" id="gruposSeccion">
        <div class="container px-4 px-lg-5 ">
            <h1 class="text-start mt-0">Grupos de becados</h1>
            <div class="row gx-4 gx-lg-5 ">

                <?php
                $conexion = new baseDeDatos();
                $sql = "SELECT * FROM jugadores ORDER BY cantidad_spl_victoria DESC";
                $conexion->conectar();

                $sql = "SELECT * FROM grupo_becados";
                $gruposBD = $conexion->conexion->query($sql);
                $gruposBD = $gruposBD->fetch_all(MYSQLI_ASSOC);
                foreach ($gruposBD as $grupo) {
                    $jugadores = [];
                    $sql = "SELECT * FROM jugadores WHERE grupo_becado_id = $grupo[id] ORDER BY cantidad_spl_victoria DESC";
                    $jugadoresBD = $conexion->conexion->query($sql);
                    $jugadoresBD = $jugadoresBD->fetch_all(MYSQLI_ASSOC);
                    foreach ($jugadoresBD as $jugador) {
                        $jugadores[] = $jugador;
                    }
                    $respuesta[] = [
                        'id' => $grupo['id'],
                        'titulo' => $grupo['titulo'],
                        'cantidad_copas' => $grupo['titulo'],
                        'jugadores' => $jugadores
                    ];
                }
                $conexion->desconectar();

                foreach ($respuesta as $dato) {
                    $armandoJugador = '';
                    $contador = 0;
                    foreach($dato['jugadores'] as $jugador){
                        $contador = $contador + 1;
                        $armandoJugador .= "
                            <tr>
                                <th scope='row'>$contador</th>
                                <td>$jugador[nombre]</td>
                                <td>$jugador[cantidad_copas]</td>
                            </tr>
                        ";

                    }
                    echo "
                        <div class='col-12 col-lg-6'>
                            <h2 class='d-flex justify-content-center'>$dato[titulo]</h2>
                            <table class='table'>
                                <thead>
                                    <tr class='table-dark-green'>
                                        <th scope='col' style='border-top-left-radius: 1em; justify-content: center;'>#</th>
                                        <th scope='col'>Nombre</th>
                                        <th scope='col' style='border-top-right-radius: 1em;'>
                                    <div ><img style='width: 2em; margin-right: 0;' src='media/copa.svg' alt='copa SLP'></div>
                                </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    $armandoJugador
                                </tbody>
                            </table>
                        </div>
                    ";
                }
                ?>
            </div>
        </div>
        <div class="flex-center">
            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Ver más </button>
        </div>
        <div class="collapse" id="collapseExample">
            <div class="card card-body ">
                <p class="flex-center">No hay más grupos</p>
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
    <script src="<?= general::constante('url') ?>/js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>

