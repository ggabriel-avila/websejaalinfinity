<?php

include '../../configuracion/baseDeDatos.php';
include '../../seguridad/apiRespuesta.php';
include '../../seguridad/usuarioAdministrador.php';

class grupos extends baseDeDatos
{

    protected string $titulo;
    protected string $jugadores;

    /**
     *  @param string $titulo titulo del grupo
     *  @param string $jugadores lista de los jugadores separado por comas
     *  @return void
     */
    public function __construct(string $titulo = '', string $jugadores = '')
    {
        $this->titulo = $titulo;
        $this->jugadores = $jugadores;
    }
    /**
     *  @return void
     */
    public function crear(): void
    {
        $this->conectar();
        $idGrupo = $this->crearGrupo();
        $this->crearRelacion($idGrupo);
        $this->desconectar();
    }

    public function crearRelacion($id)
    {
        $this->conectar();
        $jugadores = explode(',', $this->jugadores);
        foreach ($jugadores as $jugador) {
            $nombre = $this->conexion->real_escape_string(explode(' - ', $jugador)[0]);
            $idJugador = $this->conexion->real_escape_string(explode(' - ', $jugador)[1]);
            $sql = "UPDATE jugadores SET grupo_becado_id = $id WHERE id = $idJugador";
            if (!$datosBD = $this->conexion->query($sql)) {
                apiRespuesta::incorrecto(500, 'No se pudo crear los grupos ' . $this->conexion->error);
            }
        }
        $this->desconectar();
    }

    public function modificarTitulo($id)
    {
        $this->conectar();
        $this->titulo = $this->conexion->real_escape_string($this->titulo);
        $sql = "UPDATE grupo_becados SET titulo = '$this->titulo' WHERE id = $id";
        if (!$datosBD = $this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'no se pudo guardar los datos');
        }
        return mysqli_insert_id($this->conexion);
        $this->desconectar();
    }

    public function crearGrupo()
    {
        $sql = "INSERT INTO grupo_becados(titulo) VALUES ('$this->titulo')";
        if (!$datosBD = $this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'no se pudo guardar los datos');
        }
        return mysqli_insert_id($this->conexion);
    }

    /**
     *  @return void
     */
    public function obtener(): void
    {
        $this->conectar();
        $sql = "SELECT * FROM grupo_becados";
        if (!$gruposBD = $this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo obtener los grupos');
        }
        $gruposBD = $gruposBD->fetch_all(MYSQLI_ASSOC);
        foreach ($gruposBD as $grupo) {
            $jugadores = [];
            $sql = "SELECT * FROM jugadores WHERE grupo_becado_id = $grupo[id]";
            $jugadoresBD = $this->conexion->query($sql);
            $jugadoresBD = $jugadoresBD->fetch_all(MYSQLI_ASSOC);
            foreach ($jugadoresBD as $jugador) {
                $jugadores[] = $jugador;
            }
            $respuesta[] = [
                'id' => $grupo['id'],
                'titulo' => $grupo['titulo'],
                'jugadores' => $jugadores
            ];
        }
        apiRespuesta::correcto(200, $respuesta);
        $this->desconectar();
    }

    /**
     *  @param integer $id
     *  @return void
     */
    public function eliminar(int $id = 0): void
    {
        $this->conectar();
        $id = $this->conexion->real_escape_string($id);
        $sql = "DELETE FROM grupo_becados WHERE id = $id LIMIT 1";
        if (!$this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo obtener los grupos');
        }
        apiRespuesta::correcto();
        $this->desconectar();
    }

    /**
     *  @param integer $id
     *  @return void
     */
    public function modificar(int $id = 0): void
    {
        $this->conectar();
        $id = $this->conexion->real_escape_string($id);
        $sql = "DELETE FROM grupo_becados WHERE id = $id LIMIT 1";
        if (!$this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'No se pudo obtener los grupos');
        }
        apiRespuesta::correcto();
        $this->desconectar();
    }
}

if (!usuarioAdministrador::esAdministrador()) {
    apiRespuesta::incorrecto(400, 'Acceso denegado');
}
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $usuario = new grupos();
        $usuario->obtener();
        break;
    case 'POST':
        if ($_POST['method'] == 'eliminar') {
            $usuario = new grupos();
            $usuario->eliminar($_POST['id']);
        }
        if ($_POST['method'] == 'crear') {
            $usuario = new grupos($_POST['titulo'], $_POST['jugadores']);
            $usuario->crear();
        }
        if ($_POST['method'] == 'modificar') {
            $usuario = new grupos($_POST['titulo'], $_POST['jugadores']);
            $usuario->crearRelacion($_POST['id']);
            $usuario->modificarTitulo($_POST['id']);
        }
        break;
    default:
        apiRespuesta::incorrecto(400, 'accion incorrecta');
}
