<?php
require '../database.php';
require '../DAO/DAO_Usuarios.php';
require '../DAO/DAO_Compra.php';
require '../DAO/DAO_Productos.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $compra = Compra::getAllCompras();
    if ($compra) {
        $datos["estado"] = 1;
        //wprint_r($user);
        $datos["compras"] = $compra;
        //print_r($datos);
        for ($index = 0; $index < count($datos["compras"]); $index++) {
            $user = Usuarios::getByIdUsuario($compra[$index]["id_usuario"]);
            $datos["compras"][$index]["id_usuario"] = $user;
        }
              
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}
