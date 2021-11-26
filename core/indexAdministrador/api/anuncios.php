<?php

include '../../configuracion/baseDeDatos.php';
include '../../seguridad/apiRespuesta.php';
include '../../seguridad/usuarioAdministrador.php';

class anuncio extends baseDeDatos
{

    private string $id;
    private string $titulo;
    private string $descripcion;
    private string $fecha;

    public function __construct(string $id = null, string $titulo = null, string $descripcion = null, string $fecha = null)
    {
        $this->id          = strToLower($id);
        $this->titulo      = strToLower($titulo);
        $this->descripcion = strToLower($descripcion);
        $this->fecha       = strToLower($fecha);
    }

    /**
     *  @return void
     */
    public function obtener(): void
    {
        $this->conectar();
        $sql = "SELECT * FROM anuncios ORDER BY id DESC";
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
    public function agregar(): void
    {
        $this->conectar();

        $this->titulo      = $this->conexion->real_escape_string($this->titulo);
        $this->descripcion = $this->conexion->real_escape_string($this->descripcion);
        $this->fecha       = $this->conexion->real_escape_string($this->fecha);

        $sql = "INSERT INTO anuncios(titulo, descripcion, fecha) VALUES ('$this->titulo', '$this->descripcion', '$this->fecha')";
        if (!$this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo agregar el anuncio');
        }
        apiRespuesta::correcto();
        $this->desconectar();
    }

    /**
     *  @return void
     */
    public function modificar(): void
    {
        $this->conectar();

        $this->id      = $this->conexion->real_escape_string($this->id);
        $this->titulo      = $this->conexion->real_escape_string($this->titulo);
        $this->descripcion = $this->conexion->real_escape_string($this->descripcion);
        $this->fecha       = $this->conexion->real_escape_string($this->fecha);

        $sql = "UPDATE anuncios SET TITULO = '$this->titulo', descripcion = '$this->descripcion', fecha = '$this->fecha' WHERE id = $this->id";
        if (!$this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo agregar el anuncio');
        }
        apiRespuesta::correcto();
        $this->desconectar();
    }

    /**
     *  @return void
     */
    public function eliminar(): void
    {
        $this->conectar();

        $this->id = $this->conexion->real_escape_string($this->id);

        $sql = "DELETE FROM anuncios WHERE id = $this->id LIMIT 1";
        if (!$this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo eliminar el anuncio');
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
        $usuario = new anuncio();
        $usuario->obtener();
        break;
    case 'POST':
        if (!empty(!empty($_POST['method']) && $_POST['method'] == 'post')) {
            $usuario = new anuncio(null, $_POST['titulo'], $_POST['descripcion'], $_POST['fecha']);
            $usuario->agregar();
        } elseif (!empty($_POST['method']) && $_POST['method'] == 'put') {
            $usuario = new anuncio($_POST['id'], $_POST['titulo'], $_POST['descripcion'], $_POST['fecha']);
            $usuario->modificar();
        } elseif (!empty($_POST['method']) && $_POST['method'] == 'delete') {
            $usuario = new anuncio($_POST['id']);
            $usuario->eliminar();
        }
        break;
    default:
        apiRespuesta::incorrecto(400, 'accion incorrecta');
}
