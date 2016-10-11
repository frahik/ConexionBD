<?php
/**
 * Elimina una meta de la base de datos
 * distinguida por su identificador
 */

require 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    $retorno = Usuario::delete($body['id_usuario']);

    if ($retorno) {
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Eliminaci�n exitosa')
        );
    } else {
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Eliminaci�n fallida')
        );
    }
}
