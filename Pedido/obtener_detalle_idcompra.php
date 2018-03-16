<?php

require '../database.php';
require '../DAO/DAO_Compra.php';
require '../DAO/DAO_Pedido.php';
require '../DAO/DAO_Usuarios.php';
require '../DAO/DAO_Productos.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['id_compra'])) {
        $parametro1 = $_GET['id_compra'];
        $detalle = Pedido::getDetalleComprasByIdCompra($parametro1);
        if ($detalle) {
            $datos["estado"] = 1;
            $datos["detalles"]=$detalle;
            for ($index = 0; $index < count($datos["detalles"]); $index++) {
                $compra= Compra::getComprasByIdCompra($detalle[$index]["idCompra"]);
                $datos["detalles"][$index]["idCompra"]=$compra[0];
            } 
            
            for ($index2 = 0; $index2 < count($datos["detalles"]); $index2++) {
                $pro = Productos::getProductById($detalle[$index2]["idProducto"]);
                $datos["detalles"][$index2]["idProducto"]=$pro[0];        
            } 
            for ($index3 = 0; $index3 < count($datos["detalles"]); $index3++) {
                $user= Usuarios::getByIdUsuario($datos["detalles"][$index3]["idCompra"]["id_usuario"]);
                $datos["detalles"][$index3]["idCompra"]["id_usuario"]=$user;
                
            }
            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Ha ocurrido un error"
             ));
            }
        }
    } else {
    // Enviar respuesta de error
        print json_encode(
                       array(
                            'estado' => 3,
                            'mensaje' => 'Se necesita un identificador'
                        )
        );
}



