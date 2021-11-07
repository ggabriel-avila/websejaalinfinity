<?php

namespace configuracion;

session_start();

abstract class general
{
    /**
     * @var string config.json
     */
    public static function configuraciones()
    {
        return json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'core/configuracion/config.json'), true);
    }

    /**
     * @param string $constante
     * @return string|bool
     */
    public static function constante(string $constante):string|bool
    {
        $configuraciones = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'core/configuracion/config.json'), true);
        try {
            return $configuraciones['constante'][$constante];
        } catch (\Throwable $th) {
            return false;
        }
    }
}