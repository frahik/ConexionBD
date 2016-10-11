<?php

/**
 * Representa el la estructura de las usuarios
 * almacenadas en la base de datos
 */
require 'Database.php';

class Usuario
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Usuario'
     *
     * @param $id_usuario Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM Usuario";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene los campos de una Usuario con un identificador
     * determinado
     *
     * @param $id_usuario Identificador de la Usuario
     * @return mixed
     */
    public static function getById($id_usuario)
    {
        // Consulta de la Usuario
        $consulta = "SELECT id_usuario,
                            nombre,
							correo,
							contrase�a
                            FROM Usuario
                            WHERE id_usuario = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id_usuario));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $id_usuario      identificador
     * @param $nombre      nuevo nombre
     * @param $apellidos nuevos apellidos
     * @param $correo    nuevo correo
     * @param $contrase�a   nueva contrase�a
     */
    public static function update(
        $id_usuario,
        $nombre,
        $correo,
        $contrase�a)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE Usuario" .
            " SET nombre=?, correo=?, contrase�a=?" .
            "WHERE id_usuario=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $correo, $contrase�a, $id_usuario));

        return $cmd;
    }

    /**
     * Insertar una nueva Usuario
     *
     * @param $nombre      nombre del nuevo registro
     * @param $apellidos descripci�n del nuevo registro
     * @param $correo    correo del nuevo registro
     * @param $contrase�a   contrase�a del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
        $nombre,
        $correo,
        $contrase�a
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO Usuario ( " .
            "nombre," .
            " correo," .
            " contrase�a)" .
            " VALUES( ?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nombre,
                $correo,
                $contrase�a
            )
        );

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id_usuario identificador de la Usuario
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($id_usuario)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM Usuario WHERE id_usuario=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id_usuario));
    }
}

?>