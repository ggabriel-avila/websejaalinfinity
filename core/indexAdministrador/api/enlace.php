<?php

include '../../configuracion/baseDeDatos.php';
include '../../seguridad/apiRespuesta.php';
include '../../seguridad/usuarioAdministrador.php';

class enlace extends baseDeDatos
{

    private string $id;
    private string $enlace;

    public function __construct(string $id = null, string $enlace = null)
    {
        $this->id       = strToLower($id);
        $this->enlace   = strToLower($enlace);
    }

    /**
     *  @return void
     */
    public function obtener(): void
    {
        $this->conectar();
        $sql = "SELECT * FROM enlaces";
        if (!$datosBD = $this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo obtener los enlaces');
        }
        $datos = $datosBD->fetch_all(MYSQLI_ASSOC);
        apiRespuesta::correcto(200, $datos);
        $this->desconectar();
    }

    /**
     *  @return void
     */
    public function modificar(): void
    {
        $this->conectar();

        $this->id     = $this->conexion->real_escape_string($this->id);
        $this->enlace = $this->conexion->real_escape_string($this->enlace);

        $sql = "UPDATE enlaces SET enlace = '$this->enlace' WHERE id = $this->id";
        if (!$this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo modificar los enlaces');
        }
        apiRespuesta::correcto();
        $this->desconectar();
    }
}

if (!usuarioAdministrador::estaLogeado()) {
    apiRespuesta::incorrecto(403, 'No tenes permisos para realizar esta accion');
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $usuario = new enlace();
        $usuario->obtener();
        break;
    case 'POST':
        $usuario = new enlace($_POST['id'], $_POST['enlace']);
        $usuario->modificar();
        break;
    default:
        apiRespuesta::incorrecto(400, 'accion incorrecta');
}
