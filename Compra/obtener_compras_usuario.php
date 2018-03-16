<?php
require '../database.php';
require '../DAO/DAO_Usuarios.php';
require '../DAO/DAO_Compra.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_usuario'])) {
        // Obtener parámetro idalumno
        $parametro1 = $_GET['id_usuario'];
        // Manejar petición GET
        $compra = Compra::getComprasByIdUsuario($parametro1);
        if ($compra) {
            $datos["estado"] = 1;
            //wprint_r($user);
            $datos["compras"] = $compra;
            for ($index = 0; $index < count($datos["compras"]); $index++) {
                $aux = $index;
                $user = Usuarios::getByIdUsuario($compra[$aux]["id_usuario"]);
                $datos["compras"][$aux]["id_usuario"] = $user;
                //$aux=$aux+1;
            }
            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Ha ocurrido un error"
            ));
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
}