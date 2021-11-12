<?php

include '../../configuracion/baseDeDatos.php';
include '../../seguridad/apiRespuesta.php';
include '../../seguridad/usuarioAdministrador.php';

class jugadores extends baseDeDatos
{
    /**
     *  @return void
     */
    public function obtener(): void
    {
        $this->conectar();
        $sql = "SELECT * FROM jugadores";
        if (!$datosBD = $this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo obtener los enlaces');
        }
        $datos = $datosBD->fetch_all(MYSQLI_ASSOC);
        apiRespuesta::correcto(200, $datos);
        $this->desconectar();
    }
}

$usuario = new jugadores();
$usuario->obtener();