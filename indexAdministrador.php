<?php

require 'core/configuracion/configuracion.php';
require 'core/seguridad/usuarioAdministrador.php';

use configuracion\general;

if (!usuarioAdministrador::estaLogeado()) {
  header('location: login');
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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,600;0,800;1,600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/estilos.css" rel="stylesheet" />
  <input type="hidden" value="<?= general::constante('url') ?>/core/indexAdministrador/api/enlace" id="apiEnlace">
  <input type="hidden" value="<?= general::constante('url') ?>/core/indexAdministrador/api/anuncios" id="apiAnuncios">
</head>

<body id="page-top">
  <header>
    <div class="" style="background-color:white;">
      <div class="modoadmin justify-content-start">
        <div class="signal d-none d-lg-block">
          <h1>ESTAS EN MODO ADMINISTRADOR</h1>
        </div>
        <button onclick="window.location.href='<?= general::constante('url') ?>/core/login/api/cerrarSesion.php'" class="d-none d-lg-block">
          CERRAR SESIÓN
        </button>
      </div>
      <div class="d-flex justify-content-end" id="enlaces">
        <div class="RedesHeader d-none d-lg-block">
          <button v-for="enlace in enlaces" type="button" id="eliminar" @click="abrirModalEditar(enlace.id, enlace.enlace)"><img class="delete" :src="enlace.imagen" alt="Editar Enlace">
          </button>
          <!-- Modal -->
          <div class="modal fade" id="editarEnlace" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h2 class="modal-title" id="staticBackdropLabel">Editar enlace</h2>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Dirección URL</label>
                    <input type="url" class="form-control" id="exampleFormControlInput1" v-model="enlace" placeholder="https://">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" id="enviar" class="boton" @click="modificar($event)">Aceptar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
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
            <li class="nav-item d-sm-block d-md-none"><a class="nav-link" href="#tablaGeneralSeccion">Ranking y
                tablas</a></li>
            <!--DROPDOWN INFO BECAS-->
            <li class="nav-item dropdown d-none d-lg-block">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ranking</a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="#tablaGeneralSeccion">Tabla general</a></li>
                <li><a class="dropdown-item" href="#gruposSeccion">Grupos de becados</a></li>
              </ul>
            </li>
            <div class="d-sm-block d-md-none">
              <a href="<?= general::constante('url') ?>/core/login/api/cerrarSesion.php">
                CERRAR SESIÓN
              </a>
            </div>
            <div class="logoHeaderMobile d-sm-block d-md-none">
              <button type="button" id="eliminar" data-bs-toggle="modal" data-bs-target="#editarEnlaceMobile"><img class="delete" src="media/discordeditable.svg" alt="editar ">
              </button>
              <!-- Modal -->
              <div class="modal fade" id="editarEnlaceMobile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title" id="staticBackdropLabel">Editar enlace</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Dirección URL</label>
                        <input type="url" class="form-control" id="exampleFormControlInput1" placeholder="https://">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Aceptar" class="btn btn-primary" id="enviar" class="boton">
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" id="eliminar" data-bs-toggle="modal" data-bs-target="#editarEnlaceMobile"><img class="delete" src="media/instagrameditable.svg" alt="editar ">
              </button>
              <!-- Modal -->
              <div class="modal fade" id="editarEnlaceMobile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title" id="staticBackdropLabel">Editar enlace</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Dirección URL</label>
                        <input type="url" class="form-control" id="exampleFormControlInput1" placeholder="https://">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Aceptar" class="btn btn-primary" id="enviar" class="boton">
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" id="eliminar" data-bs-toggle="modal" data-bs-target="#editarEnlaceMobile"><img class="delete" src="media/twittereditable.svg" alt="editar ">
              </button>
              <!-- Modal -->
              <div class="modal fade" id="editarEnlaceMobile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title" id="staticBackdropLabel">Editar enlace</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Dirección URL</label>
                        <input type="url" class="form-control" id="exampleFormControlInput1" placeholder="https://">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Aceptar" class="btn btn-primary" id="enviar" class="boton">
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" id="eliminar" data-bs-toggle="modal" data-bs-target="#editarEnlaceMobile"><img class="delete" src="media/twitcheditable.svg" alt="editar ">
              </button>
              <!-- Modal -->
              <div class="modal fade" id="editarEnlaceMobile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title" id="staticBackdropLabel">Editar enlace</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Dirección URL</label>
                        <input type="url" class="form-control" id="exampleFormControlInput1" placeholder="https://">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Aceptar" class="btn btn-primary" id="enviar" class="boton">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Masthead-->
  <section>
    <img src="media/baner.jpg" alt="sejaal" style="width: 100%">
  </section>
  <!-- Quienes somos-->
  <section class="page-section" id="QuienesSomosSeccion">
    <div class="container px-4 px-lg-5">
      <h1 class="text-start mt-0">Quienes somos</h1>
      <div class="row gx-4 gx-lg-5">
        <img class="col-lg-6 col-12" src="media/logo-extendido.svg" alt="Logo Sejaal Infinity">
        <div class="col-lg-6 col-12">
          <p>Somos un grupo de personas que decidimos invertir en un proyecto basado en los juegos NFT en este caso Axie
            Infinity con el objetivo de poder ayudar a personas dándoles las herramientas para adentrarse en este mundo
            y que estas a su vez nos ayuden a nosotros generando ingresos para hacer que el proyecto Seejal Infinity
            pueda llegar a más personas y crecer cada día más.</p>
          <button> <a href="https://docs.google.com/forms/d/e/1FAIpQLSfm9WbmjPkamHD976TAUQh9BTUwpIKywv_b8ocufR78GfaLnA/viewform" target="_blank">Completá el formulario</a> </button>
        </div>
      </div>
    </div>
  </section>
  <!-- ANUNCIOS-->
  <section class="page-section" id="AnunciosSeccion">
    <div class="container px-4 px-lg-5">
      <h1 class="text-start mt-0">Anuncios</h1>

      <!--MODAL AGREGAR-->
      <!-- Button trigger modal -->
      <button type="button buttonAgregar" id="agregar" data-bs-toggle="modal" data-bs-target="#agregarAnuncio">AGREGAR
      </button>

      <!-- Modal -->
      <div class="modal fade" id="agregarAnuncio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Agregar anuncio</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Título</span>
                <input type="text" class="form-control" v-model="titulo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="50" placeholder="Introduce como máximo 50 caracteres" required>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                <input type="date" class="form-control" v-model="fecha" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="10" placeholder="Ex: 10/10/2020" required>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                <textarea class="form-control" v-model="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea maxlength="1000" required>
                        </div>
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                       <button type="submit" class="btn btn-primary" id="enviar2" class="boton" @click="agregar($event)">Aceptar</button>
                     </div>
                   </div>
                 </div>
               </div>


           <!--ANUNCIOS CONTAINERS-->
                <div class="row gx-4 gx-lg-5-an">
                    <div class="col-lg-6 col-12 card" v-for="anuncio in anuncios">
                        <div class="anuncios">
                            <div class="card-body">
                              <div style="display: flex;justify-content: end;">
                                <!--MODAL MODIFICAR-->
                                <!-- Button trigger modal -->
                                 <button type="button" id="eliminar" data-bs-toggle="modal" data-bs-target="#eliminarAnuncio" @click="id = anuncio.id"><img class="delete" src="media/delete.svg" alt="eliminar">
                                 </button>
                              </div>
                               <h3 >{{anuncio.titulo}}</h3>
                               <h4> <span class="badge bg-light text-dark">NUEVO</span> {{anuncio.fecha}}
                                <!--MODAL MODIFICAR-->
                                <!-- Button trigger modal -->
                                 <button type="button buttonAgregar" id="agregar" @click="abrirModalEditar(anuncio)">MODIFICAR
                                 </button>
                                 </div></h4>
                               <p class="card-text">{{anuncio.descripcion}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--VER MÁS ANUNCIOS-->
                <div class="flex-center">
                <!-- Modal -->
                <div class="modal fade" id="eliminarAnuncio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">       
                      <h2 class="modal-title" id="staticBackdropLabel">Eliminar anuncio</h2>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h4>¿Desea eliminar permanentemente este anuncio?</h4>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" id="enviar" class="boton" onclick="anunciosVue.eliminar(this)">Enviar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modificarAnuncio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">       
                      <h5 class="modal-title" id="staticBackdropLabel">Modificar anuncio</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>                      
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-default">Título</span>
                          <input type="text" class="form-control" v-model="titulo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="50" placeholder="Introduce como máximo 50 caracteres" required>
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-default">Fecha</span>
                          <input type="date" class="form-control" v-model="fecha" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="10" placeholder="Ex: 10/10/2020" required>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                          <textarea class="form-control" v-model="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea maxlength="1000" required>
                        </div>
                      </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" id="enviar3" class="boton" @click="modificar($event)">Enviar</button>
                      </div>
                    </div>
                  </div>
                </div>
            <button  type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Ver más </button></div>
            <div class="collapse" id="collapseExample">
              <div class="card card-body ">
                <p class="flex-center">No hay más anuncios</p>
              </div>
            </div>
            </div>
        </section>

        <!-- Información de becas-->

        <section class="page-section" id="infoBecasSeccion">
            <div class="container px-4 px-lg-5">
                <h1 class="text-start mt-0">Información de becas</h1>
                <div class="row gx-4 gx-lg-5">
                    <h2>-SLP mínimos y porcentaje</h2>
                    <div class="col-lg-6 col-12">
                        <p><b>Primer mes:</b>El becado tendrá que hacer un mínimo de 3630 SLP, este número es menor que el de los otros meses ya que los primeros días el becado deberá gastar sus energías para subir de nivel sus axies lo que no le permitirá ganar SLP jugando arena.  Este número se obtiene al sumar 75 SLP diarios la primer semana + 135 SLP diarios los otros días restantes del mes.
                        Es decir, el becado podrá jugar la primer semana  las 20 energías diarias en modo PVE y a partir de ahí deberá gastar sus energias jugando PVP para poder llegar a los 135 SLP diarios (en promedio). <b>De estos 3630 SLP, el 30% serán para el becado y el 70% para Sejaal Infinity, todos los SLP excedentes a este número, le corresponderán 60% al becado y 40% a Sejaal Infinity </b> </p>
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
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-12 col-12">
                       <p><b>Nota importante:</b></p>
                        <hr>
                       <p>En caso de que el becado no llegue a hacer los SLP mínimos correspondiente a su mes (ya sea 3630 el primer mes o 4050 a partir del segundo), a su pago se le restará la parte que le corresponde a Sejaal Infinity. Por ejemplo, si el 2do mes un becado no consigue llegar a los 4050 SLP, Sejaal Infinity tomará su parte (2430 SLP) y le dará lo restante al becado.
                       En caso de que el becado no consiga hacer los SLP correspondientes a Sejaal Infinity se le quitará la beca.</p>
                    </div>
                </div>  
                 <!-- VER MAS-->
                 <div class="flex-center">
                <button  type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Ver más </button></div>
                <div class="collapse" id="collapseExample">
                <div class="row gx-4 gx-lg-5">
                    <h2>-Grupos</h2>
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>Mensualmente cada becado competirá junto con otros 3 becados por conseguir un 10% más de SLP mensuales, es decir si el becado el primer mes sale primero de su grupo se le pagará el 40%, y si está en el 2do mes en adelante se le pagará el 50% de los SLP obtenidos (Sin tener en cuenta el excedente, que será igual de un 60% para el becado)</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>El día 17 de cada mes a las 00:00hs UTC se reiniciará el mes y se obtendrá el ganador de cada grupo, quedará primero el becado que más copas tenga de su grupo.</li>
                            <li>El día 18 de cada mes se anunciarán los nuevos grupos, se podrán ver en nuestra página web.</li>
                        </ul>
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5">
                    <h2>-Pagos <img src="media/slp.png" alt="SLP transparente" style="width: 2.5em;"></h2> 
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>El pago se realizará en SLP y se le enviará directamente a la cuenta de binance de cada becado.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>El pago se realizará cada mes, el mismo día que el becado ingreso a Sejaal Infinity, es decir, si el becado comenzó si beca el día 3 de marzo, su pago se realizará el día 3 de cada mes (su primer pago será día 3 de abril).</li>
                        </ul>
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5">
                    <h2>-Renunciar a la beca</h2>
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>Cada becado puede renunciar a su beca en cualquier momento, pero en caso de no completar el mes y que la renuncia sea en el transcurso de los 30 días, no se efectuará el pago.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>Se agradece el aviso anticipado de la salida, así  lo tenemos en cuenta para proceder.</li>
                        </ul>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <h2>-Ban de cuentas</h2>
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>En el caso de que un becado cometa errores y se le banee la cuenta, el deberá pagar los axies que se le habían proporcionado.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-12">
                        <ul>
                            <li>Los motivos de ban pueden ser:</li>
                            <ul>
                                <li>Las multicuentas en un mismo dispositivo.</li>
                                <li>Tener mas de dos cuentas abiertas en la misma IP de Wi-Fi.</li>
                                <li>Todo programa de terceros no autorizados</li>
                            </ul>
                        </ul>
                    </div>
                </div>
                </div>
            </div>

        </section>
        <!-- Fin Información de becas-->
        <!-- Ranking-->
        <section class="page-section" id="tablaGeneralSeccion">
        <div class="container px-4 px-lg-5 ">
            <h1 class="text-start mt-0">Ranking</h1>
            <p>Las tablas se actualizarán de manera mensual, específicamente cada 1ro de mes.</p>
          <div class="row gx-4 gx-lg-5 tablaMobile"> 
          <h2 class="d-flex justify-content-center">Tabla general</h2> 
          <div class="col-12 d-flex justify-content-center" >
        <table class="table">
          <thead >
            <tr class="table-dark">
              <th scope="col" style="border-top-left-radius: 1em; justify-content: center;">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Promedio de SLP </th>
              <th scope="col">SLP por victoria</th>
              <th scope="col" style="border-top-right-radius: 1em;"><div style="width: 2em; margin-right: 0;"><img src="media/copa.svg" alt="copa SLP"></div></th>
            </tr>
          </thead>
          <tbody>
            <tr >
              <th scope="row">1</th>
              <td>Enzo Caracoch</td>
              <td>200</td>
              <td>6</td>
              <td>900</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Federico Alvarez</td>
              <td>180</td>
              <td>5</td>
              <td>850</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Franco Perez</td>
              <td>170</td>
              <td>4</td>
              <td>760</td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>Karou Rangan</td>
              <td>160</td>
              <td>4</td>
              <td>700</td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Mapache Suarez</td>
              <td>160</td>
              <td>140</td>
              <td>4</td>
            </tr>
            <tr>
              <th scope="row">6</th>
              <td>Meinah Martinez</td>
              <td>140</td>
              <td>4</td>
              <td>670</td>
            </tr>
            <tr>
              <th scope="row">7</th>
              <td>Franco Logras</td>
              <td>130</td>
              <td>2</td>
              <td>450</td>
            </tr>
            <tr>
              <th scope="row">8</th>
              <td>Micaela Rodriguez</td>
              <td>126</td>
              <td>2</td>
              <td>4500</td>
            </tr>
            <tr>
              <th scope="row">9</th>
              <td>Federico Puels</td>
              <td>120</td>
              <td>2</td>
              <td>400</td>
            </tr>
            <tr>
              <th scope="row">10</th>
              <td>Ignacio Pratto</td>
              <td>100</td>
              <td>2</td>
              <td>200</td>
            </tr>

          </tbody>
        </table>
        </div>
        </div>
        </div>
        </section>
        <!-- GRUPOS DE BECADOS-->
        <section class="page-section" id="gruposSeccion">
            <div class="container px-4 px-lg-5 ">
            <h1 class="text-start mt-0">Grupos de becados </h1>
            <!--MODAL AGREGAR-->
              <!-- Button trigger modal -->
               <button type="button buttonAgregar" id="agregar" data-bs-toggle="modal" data-bs-target="#agregarGrupo">AGREGAR
               </button>

               <!-- Modal -->
               <div class="modal fade" id="agregarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">       
                      <h5 class="modal-title" id="staticBackdropLabel">Agregar grupo</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                       <form>                      
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-default">Título del nuevo grupo</span>
                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="100" placeholder="Introduce como máximo 50 caracteres" required>
                        </div>
                        <div class="container px-4 px-lg-5 ">
                          <div class="row gx-4 gx-lg-5 " style=" height: 8em; overflow: auto; width:100%;" >
                            <div class="col-lg-6" >
                              <ul>
                              <li class="form-check" >
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                           </ul>
                            </div>                        
                          </div>                          
                        </div>                      
                      </form>
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                       <input type="submit" value="Crear" class="btn btn-primary" id="enviar" class="boton">
                     </div>
                   </div>
                 </div>
               </div>
            <p>Los grupos de becados permiten formar alianzas entre quienes reciben nuestra beca.</p>
            <div class="row gx-4 gx-lg-5 ">  
        <div class="col-12 col-lg-6" >
           <h2 class="d-flex justify-content-center">GRUPO #1</h2>
           <div style="display: flex;justify-content: end;">
                                <!--MODAL MODIFICAR-->
                                <!-- Button trigger modal -->
                                 <button type="button" id="eliminar" data-bs-toggle="modal" data-bs-target="#eliminarGrupo"><img class="delete" src="media/delete.svg" alt="eliminar">
                                 </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="eliminarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                   <div class="modal-dialog">
                                     <div class="modal-content">
                                       <div class="modal-header">       
                                        <h2 class="modal-title" id="staticBackdropLabel">Eliminar grupo</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                         <h4>¿Desea eliminar permanentemente este grupo?</h4>
                                       </div>
                                       <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                         <input type="submit" value="Aceptar" class="btn btn-primary" id="enviar" class="boton">
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                              </div>
           <table class="table">
             <thead >
               <tr class="table-dark-green">
                 <th scope="col" style="border-top-left-radius: 1em; justify-content: center;">#</th>
                 <th scope="col">Nombre</th>
                 <th scope="col" style="border-top-right-radius: 1em;"><div style="width: 2em; margin-right: 0;"><img src="media/copa.svg" alt="copa SLP"></div></th>
               </tr>
             </thead>
             <tbody>
               <tr class="table-success">
                 <th scope="row">1</th>
                 <td>Enzo Caracoch</td>
                 <td>900</td>
               </tr>
               <tr>
                 <th scope="row">2</th>
                 <td>Federico Alvarez</td>
                 <td>850</td>
               </tr>
               <tr>
                 <th scope="row">3</th>
                 <td>Franco Perez</td>
                 <td>760</td>
               </tr>
               <tr>
                 <th scope="row">4</th>
                 <td>Karou Rangan</td>
                 <td>700</td>
               </tr>
               <tr>
                 <th scope="row">5</th>
                 <td>Mapache Suarez</td>
                 <td>4</td>
               </tr>
             </tbody>
           </table>
           <div style="display: flex;justify-content: center;">
             <!--MODAL MODIFICAR-->
              <!-- Button trigger modal -->
               <button type="button buttonAgregar" id="agregar" data-bs-toggle="modal" data-bs-target="#modificargrupo">MODIFICAR
               </button>
                                 <!-- Modal -->
               <div class="modal fade" id="modificargrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">       
                      <h5 class="modal-title" id="staticBackdropLabel">Modificar grupo</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                       <form>                      
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-default">Título del grupo</span>
                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="100"  required>
                        </div>
                        <div class="container px-4 px-lg-5 ">
                          <div class="row gx-4 gx-lg-5 " style=" height: 8em; overflow: auto; width:100%;" >
                            <div class="col-lg-6" >
                              <ul>
                              <li class="form-check" >
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                           </ul>
                            </div>                        
                          </div>                          
                        </div>
                      </form>
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                       <input type="submit" value="Actualizar" class="btn btn-primary" id="enviar" class="boton">
                     </div>
                   </div>
                 </div>
               </div>
           </div>
        </div>
        <div class="col-12 col-lg-6" >
           <h2 class="d-flex justify-content-center">GRUPO #2</h2>
           <div style="display: flex;justify-content: end;">
                                <!--MODAL MODIFICAR-->
                                <!-- Button trigger modal -->
                                 <button type="button" id="eliminar" data-bs-toggle="modal" data-bs-target="#eliminarGrupo"><img class="delete" src="media/delete.svg" alt="eliminar">
                                 </button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="eliminarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                   <div class="modal-dialog">
                                     <div class="modal-content">
                                       <div class="modal-header">       
                                        <h2 class="modal-title" id="staticBackdropLabel">Eliminar grupo</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                         <h4>¿Desea eliminar permanentemente este grupo?</h4>
                                       </div>
                                       <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                         <input type="submit" value="Aceptar" class="btn btn-primary" id="enviar" class="boton">
                                       </div>
                                     </div>
                                   </div>
                                 </div>
                              </div>
           <table class="table">
             <thead >
               <tr class="table-dark-green">
                 <th scope="col" style="border-top-left-radius: 1em; justify-content: center;">#</th>
                 <th scope="col">Nombre</th>
                 <th scope="col" style="border-top-right-radius: 1em;"><div style="width: 2em; margin-right: 0;"><img src="media/copa.svg" alt="copa SLP"></div></th>
               </tr>
             </thead>
             <tbody>
               <tr class="table-success">
                 <th scope="row">1</th>
                 <td>Enzo Caracoch</td>
                 <td>900</td>
               </tr>
               <tr>
                 <th scope="row">2</th>
                 <td>Federico Alvarez</td>
                 <td>850</td>
               </tr>
               <tr>
                 <th scope="row">3</th>
                 <td>Franco Perez</td>
                 <td>760</td>
               </tr>
               <tr>
                 <th scope="row">4</th>
                 <td>Karou Rangan</td>
                 <td>700</td>
               </tr>
               <tr>
                 <th scope="row">5</th>
                 <td>Mapache Suarez</td>
                 <td>4</td>
               </tr>
             </tbody>
           </table>
           <div style="display: flex;justify-content: center;">
             <!--MODAL MODIFICAR-->
              <!-- Button trigger modal -->
               <button type="button buttonAgregar" id="agregar" data-bs-toggle="modal" data-bs-target="#modificargrupo">MODIFICAR
               </button>
              <!-- Modal -->
               <div class="modal fade" id="modificargrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">       
                      <h5 class="modal-title" id="staticBackdropLabel">Modificar grupo</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                       <form>                      
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="inputGroup-sizing-default">Título del grupo</span>
                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" maxlength="100"  required>
                        </div>
                        <div class="container px-4 px-lg-5 ">
                          <div class="row gx-4 gx-lg-5 " style=" height: 8em; overflow: auto; width:100%;" >
                            <div class="col-lg-6" >
                              <ul>
                              <li class="form-check" >
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                             <li class="form-check">
                               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                               <label class="form-check-label" for="flexCheckDefault">
                                Usuario 
                               </label>
                             </li>
                           </ul>
                            </div>                        
                          </div>                          
                        </div>
                      </form>
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                       <input type="submit" value="Actualizar" class="btn btn-primary" id="enviar" class="boton">
                     </div>
                   </div>
                 </div>
               </div>
           </div>
        </div>
        </div>
        </div>
        <div class="flex-center">
            <button  type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Ver más </button></div>
            <div class="collapse" id="collapseExample">
              <div class="card card-body ">
                <p class="flex-center">No hay más grupos</p>
              </div>
            </div>
        </section>



        <!-- Footer-->
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
        <script src="<?= general::constante('url') ?>/js/indexAdministrador/enlaces.js"></script>
        <script src="<?= general::constante('url') ?>/js/indexAdministrador/anuncios.js"></script>
    </body>
</html>