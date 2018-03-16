<?php
require '../database.php';
require '../DAO/DAO_Usuarios.php';
require '../DAO/DAO_Compra.php';
require '../DAO/DAO_Pedido.php';
require '../DAO/DAO_Productos.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $detalle = Pedido::getAllDetallePedido();
    if ($detalle) {
        $datos["estado"] = 1;
        //wprint_r($user);
        $datos["detalles"] = $detalle;

        //DATOS COMPRA
        for ($index = 0; $index < count($datos["detalles"]); $index++) {
            $compra= Compra::getComprasByIdCompra($datos["detalles"][$index]["idCompra"]);
            $datos["detalles"][$index]["idCompra"]=$compra[0];
            //datosUsuario                   
            $user = Usuarios::getByIdUsuario($datos["detalles"][$index]["idCompra"]["id_usuario"]);
            $datos["detalles"][$index]["idCompra"]["id_usuario"]=$user;
            $pro= Productos::getProductById($detalle[$index]["idProducto"]);
            $datos["detalles"][$index]["idProducto"]=$pro[0];

        }
     
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

