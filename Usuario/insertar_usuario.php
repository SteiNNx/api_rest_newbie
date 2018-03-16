<?php
require '../database.php';

require '../DAO/DAO_Usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar Alumno
    if (!Usuarios::getByNameUsuario($body['user'])) {
        $retorno = Usuarios::insertUsuario(
                        $body['user'], $body['pass'], $body['nombre'], $body['apellido']);
        if ($retorno) {
            $json_string = json_encode(array("estado" => 1, "mensaje" => "Creacion correcta"));
            echo $json_string;
        } else {
            $json_string = json_encode(array("estado" => 2, "mensaje" => "No se Creo correcta"));
            echo $json_string;
        }
    } else {
        $json_string = json_encode(array("estado" => 3, "mensaje" => "Usuario ya existe"));
        echo $json_string;
    }
}

