<?php

include '../configuracion/baseDeDatos.php';
include '../seguridad/apiRespuesta.php';
include '../seguridad/usuarioAdministrador.php';

header('Access-Control-Allow-Origin: *');

class scraping extends baseDeDatos
{


    private $datos;

    /**
     *  @param string $datos
     *  @return void
     */
    public function __construct(string $datos = '')
    {
        if(strlen($datos) == 0){
            apiRespuesta::incorrecto(403, 'Acceso denegado');
        }
        try {
            $this->datos = json_decode($datos, true);
        } catch (\Throwable $th) {
            apiRespuesta::incorrecto(403, 'Acceso denegado');
        }
        $this->actualizarDatos();
        $this->verificarExisten();
        $this->insertarNuevosDatos();
    }

    
    public function actualizarDatos()
    {
        $this->conectar();
        $datos = [];
        foreach($this->datos as $dato){
            $nombre = $dato['nombre'];
            $promedioSpl = $dato['promedio_spl'];
            $cantidadCopas = $dato['cantidad_copas'];
            $cantidadSplVictoria = $dato['cantidad_spl_victoria'];
            $query = "UPDATE jugadores SET promedio_spl = '$promedioSpl', cantidad_copas = '$cantidadCopas', cantidad_spl_victoria = '$cantidadSplVictoria' WHERE nombre = '$nombre' LIMIT 1";
            echo $query;
            $this->conexion->query($query);
            if($this->conexion->affected_rows == 0){
                $datos[] = [
                    'nombre' => $nombre,
                    'promedio_spl' => $promedioSpl,
                    'cantidad_copas' => $cantidadCopas,
                    'cantidad_spl_victoria' => $cantidadSplVictoria
                ];
            }
        }
        $this->desconectar();
    }

    public function verificarExisten()
    {
        $this->conectar();
        $datos = [];
        foreach($this->datos as $dato){
            $nombre = $dato['nombre'];
            $promedioSpl = $dato['promedio_spl'];
            $cantidadCopas = $dato['cantidad_copas'];
            $cantidadSplVictoria = $dato['cantidad_spl_victoria'];
            $query = "SELECT * FROM jugadores WHERE nombre = '$nombre'";
            $datosBD = $this->conexion->query($query);
            if($datosBD->num_rows == 0){
                $datos[] = [
                    'nombre' => $nombre,
                    'promedio_spl' => $promedioSpl,
                    'cantidad_copas' => $cantidadCopas,
                    'cantidad_spl_victoria' => $cantidadSplVictoria
                ];
            }
        }
        $this->desconectar();
        $this->datos = $datos;
    }

    public function insertarNuevosDatos()
    {
        $this->conectar();
        if($this->datos != null){
            foreach($this->datos as $dato){
                $nombre = $dato['nombre'];
                $promedioSpl = $dato['promedio_spl'];
                $cantidadCopas = $dato['cantidad_copas'];
                $cantidadSplVictoria = $dato['cantidad_spl_victoria'];
                $query = "INSERT INTO jugadores(nombre, promedio_spl, cantidad_copas, cantidad_spl_victoria) VALUES ('$nombre', '$promedioSpl', '$cantidadCopas', '$cantidadSplVictoria')";
                $this->conexion->query($query);
            }
            $this->desconectar();
        }
        // $query = "UPDATE jugadores SET nombre = '$nombre', promedio_spl = '$promedioSpl', cantidad_copas = '$cantidadCopas', cantidad_spl_victoria = '$cantidadSplVictoria' LIMIT 1";
    }
}

$scraping = new scraping($_POST['parametros']);
