<?php

class Pedido {

    function __construct() {
        
    }

    /**
     * Retorna en la fila especificada de la tabla 'Alumnos'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAllDetallePedido() {
        $consulta = "SELECT * FROM detallecompra";
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

    public static function getDetalleComprasByIdCompra($idAlumno) {
        // Consulta de la tabla Alumnos
        $consulta = "SELECT * from detallecompra
                             WHERE idCompra = ?";
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
    public static function insertarDetallePedido(
        $id_compra, $id_producto,$cantidad
    ) {
        
        $comando = "INSERT INTO detallecompra (idCompra,idProducto,cantidad) VALUES('$id_compra','$id_producto','$cantidad');";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute();
    }
    

}
