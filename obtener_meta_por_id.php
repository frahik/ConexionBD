<?php
/**
 * Obtiene el detalle de una meta especificada por
 * su identificador "correo"
 */

require 'Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['correo'])) {

        // Obtener parámetro correo
        $parametro = $_GET['correo'];

        // Tratar retorno
        $retorno = Usuario::getById($parametro);


        if ($retorno) {

            $Usuario["estado"] = "1";
            $Usuario["Usuario"] = $retorno;
            // Enviar objeto json de la meta
            print json_encode($Usuario);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}

