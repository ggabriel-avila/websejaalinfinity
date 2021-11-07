<?php

include '../../configuracion/baseDeDatos.php';
include '../../seguridad/apiRespuesta.php';
include '../../seguridad/usuarioAdministrador.php';

class iniciarSesion extends baseDeDatos
{

    private string $usuario;
    private string $clave;

    public function __construct(string $usuario, string $clave)
    {
        $this->usuario = strToLower($usuario);
        $this->clave   = strToLower($clave);
    }

    /**
     *  @return void
     */
    public function ingresar(): void
    {
        $this->conectar();

        $this->usuario = $this->conexion->real_escape_string($this->usuario);
        $this->clave   = $this->conexion->real_escape_string($this->clave);

        $sql = "SELECT id,clave FROM usuarios WHERE usuario = '$this->usuario' LIMIT 1";

        if(!$datosBD = $this->conexion->query($sql)){
            apiRespuesta::incorrecto(500, "Ocurrio un problema");
        }
        $datosBD = $datosBD->fetch_assoc();
        if($datosBD == null){
            apiRespuesta::incorrecto(401, 'Usuario o contraseña incorrectos');
        }
        if(password_verify($this->clave, $datosBD['clave'])){
            $_SESSION['id'] = $datosBD['id'];
            apiRespuesta::correcto();
        }else{
            apiRespuesta::incorrecto(401, 'Usuario o contraseña incorrectos');
        }
        $this->desconectar();
    }
}

if (!usuarioAdministrador::estaLogeado()) {
    $usuario = new iniciarSesion($_POST['usuario'], $_POST['clave']);
    $usuario->ingresar();
} else {
    apiRespuesta::correcto();
}
