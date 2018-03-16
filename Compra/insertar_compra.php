<?php
require '../database.php';
require '../DAO/DAO_Compra.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar Alumno
        $retorno = Compra::inserCompra(
                        $body['id_usuario']['id_usuario'], $body['total_pago']);
        if ($retorno) {
            $json_string = json_encode(array("estado" => 1, "mensaje" => "Creacion correcta"));
            echo $json_string;
        } else {
            $json_string = json_encode(array("estado" => 2, "mensaje" => "No se Creo correcta"));
            echo $json_string;
        }
    
}

