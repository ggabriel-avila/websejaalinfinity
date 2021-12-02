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
        $idGrupo = $this->crearGrupo();
        $this->crearRelacion($idGrupo);
    }

    public function crearRelacion($id)
    {
        $this->conectar();
        if (strlen($this->jugadores) > 0) {
            $jugadores = explode(',', $this->jugadores);
            $sql = "UPDATE jugadores SET grupo_becado_id = NULL WHERE grupo_becado_id = $id";
            $this->conexion->query($sql);
            foreach ($jugadores as $jugador) {
                $idJugador = explode(' - ', $jugador)[1];
                $sql = "UPDATE jugadores SET grupo_becado_id = $id WHERE id = $idJugador";
                if (!$datosBD = $this->conexion->query($sql)) {
                    apiRespuesta::incorrecto(500, 'No se pudo crear los grupos ' . $this->conexion->error);
                }
            }
        }else{
            $sql = "UPDATE jugadores SET grupo_becado_id = NULL WHERE grupo_becado_id = $id";
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
        $this->conectar();
        $sql = "INSERT INTO grupo_becados(titulo) VALUES ('$this->titulo')";
        if (!$datosBD = $this->conexion->query($sql)) {
            apiRespuesta::incorrecto(500, 'no se pudo guardar los datos');
        }
        return mysqli_insert_id($this->conexion);
        $this->desconectar();
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
            $sql = "SELECT * FROM jugadores WHERE grupo_becado_id = $grupo[id] ORDER BY cantidad_copas DESC";
            $jugadoresBD = $this->conexion->query($sql);
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
