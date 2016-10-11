<?php
/**
 * Insertar una nueva Usuario en la base de datos
 */

require 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar Usuario
    $retorno = Usuario::insert(
        $body['nombre'],
        $body['correo'],
        $body['contrase�a']);

    if ($retorno) {
        // C�digo de �xito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Creaci�n �xitosa')
        );
    } else {
        // C�digo de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Creaci�n fallida')
        );
    }
}

