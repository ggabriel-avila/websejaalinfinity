<?php

namespace configuracion;

session_start();

abstract class general
{
    public static function requisitos():string
    {
        $url_completa = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        return '{
            "credencial":{
                "baseDeDatos": {
                    "host": "localhost",
                    "database": "sejaal_infinity",
                    "user": "root",
                    "password": ""
                }
            },
            "constante":{
                "url":"' . $url_completa . '"
            }
        }';


    }
    /**
     * @var string config.json
     */
    public static function configuraciones()
    {
        return json_decode(general::requisitos(), true);
    }

    /**
     * @param string $constante
     * @return string|bool
     */
    public static function constante(string $constante):string|bool
    {
        $configuraciones = json_decode(general::requisitos(), true);
        try {
            return $configuraciones['constante'][$constante];
        } catch (\Throwable $th) {
            return false;
        }
    }
}