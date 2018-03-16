<?php

require '../database.php';
require '../DAO/DAO_Compra.php';
require '../DAO/DAO_Pedido.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar Alumno
        $id_compra=Compra::getMaxIdCompras();
        $aux =$id_compra[0]["max"];
        print_r($body);
        
        $retorno = Pedido::insertarDetallePedido($aux, $body['idProducto']['idProducto'], $body['cantidad']);
        if ($retorno) {
            $json_string = json_encode(array("estado" => 1, "mensaje" => "Creacion correcta"));
            echo $json_string;
        } else {
            $json_string = json_encode(array("estado" => 2, "mensaje" => "No se Creo correcta"));
            echo $json_string;
        }
    
}
