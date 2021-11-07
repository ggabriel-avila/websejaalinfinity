<?php

abstract class usuarioAdministrador
{

    /**
     * verifico si es usuario
     */
    public static function esUsuario(): bool
    {
        if (!isset($_SESSION['id'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * verifico si es usuario
     */
    public static function esAdministrador(): bool
    {
        if (isset($_SESSION['id'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * verifico si esta logeado
     */
    public static function estaLogeado(): bool
    {
        if (isset($_SESSION['id'])){
            return true;
        }else{
            return false;
        }
    }
}
