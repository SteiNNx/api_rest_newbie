<?php

class Compra {

    function __construct() {
        
    }

    /**
     * Retorna en la fila especificada de la tabla 'Alumnos'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllCompras() {
        $consulta = "SELECT * FROM compra";
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

    public static function getComprasByIdUsuario($idAlumno) {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT * from compra
                             WHERE id_usuario = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idAlumno));
            // Capturar primera fila del resultado
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    public static function getMaxIdCompras() {
        $consulta = "SELECT MAX(id_compra) as max FROM compra";
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

    public static function getComprasByIdCompra($idAlumno) {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT * from compra
                             WHERE id_compra = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idAlumno));
            // Capturar primera fila del resultado
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    public static function inserCompra(
    $id_usuario, $total
    ) {
        $d = strftime("%Y-%m-%d");
        $comando = "INSERT INTO compra (id_usuario,fecha_compra,total_pago) VALUES('$id_usuario','$d','$total');";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute();
    }

}
