<?php

include 'configuracion.php';

use configuracion\general;

class baseDeDatos extends general
{

    protected string $host;
    protected string $database;
    protected string $user;
    protected string $password;

    protected $conexion;

    /**
     * inicia la conexion a la base de datos
     * @return bool
     */
    protected function conectar(): bool
    {
        $configuraciones = general::configuraciones();
        $this->host      = $configuraciones['credencial']['baseDeDatos']['host'];
        $this->database  = $configuraciones['credencial']['baseDeDatos']['database'];
        $this->user      = $configuraciones['credencial']['baseDeDatos']['user'];
        $this->password  = $configuraciones['credencial']['baseDeDatos']['password'];
        $this->conexion = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );
        if ($this->conexion->connect_error) {
            return false;
        }
        return true;
    }

    /**
     * desconecta la base de datos
     * @return bool
     */
    protected function desconectar(): bool
    {
        $this->conexion->close();
        return true;
    }
}
