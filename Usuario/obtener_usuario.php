<?php
require '../database.php';

require '../DAO/DAO_Usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $usuario = Usuarios::getAllUsuarios();
    if ($usuario) {
        $datos["estado"] = 1;
        $datos["usuarios"] = $usuario;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

