<?php
abstract class apiRespuesta
{

    /**
     * @param integer $estado indica el estado de la respuesta de la API
     * @param array $datos datos de la respuesta de la API
     */
    static public function correcto(int $estado = 200, array $datos = []): void
    {
        http_response_code($estado);
        $respuesta = [
            'status' => $estado,
            'message' => 'success',
            'data' => $datos
        ];
        echo json_encode($respuesta);
        die();
    }

    /**
     * @param integer $estado indica el estado de la respuesta de la API
     * @param string $mensaje indica el mensaje de la respuesta de la API
     */
    static public function incorrecto(int $estado = 500, string $mensaje): void
    {
        http_response_code($estado);
        $respuesta = [
            'status' => $estado,
            'message' => $mensaje
        ];
        echo json_encode($respuesta);
        die();
    }
}
