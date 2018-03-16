<?php



class Usuarios {

    function __construct() {
        
    }

    /**
     * Retorna en la fila especificada de la tabla 'Alumnos'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllUsuarios() {
        $consulta = "SELECT * FROM usuario";
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
     * Obtiene los campos de un Alumno con un identificador
     * determinado
     *
     * @param $idAlumno Identificador del alumno
     * @return mixed
     */
    public static function getUserByLoginUsuario($usuario, $contra) {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT * from usuario
                             WHERE user = ? and pass=?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usuario, $contra));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getByNameUsuario($idAlumno) {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT * from usuario
                             WHERE user = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idAlumno));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getByIdUsuario($idAlumno) {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT * from usuario
                             WHERE id_usuario = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idAlumno));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function insertUsuario(
    $user, $pass, $nombre, $apellido
    ) {
        $comando = "INSERT INTO usuario (user,pass,nombre,apellido,tipo_usuario) VALUES('$user','$pass','$nombre','$apellido','Cliente');";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute();
    }

    public static function updateUsuario(
    $id_usuario,$user, $pass, $nombre, $apellido
    ) {
        // Creando consulta UPDATE
        $consulta = "UPDATE usuario" .
                " SET user='$user', pass='$pass',nombre='$nombre',apellido='$apellido' " .
                "WHERE id_usuario='$id_usuario'";
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
        // Relacionar y ejecutar la sentencia
        $cmd->execute();
        return $cmd;
    }

}
