<?php
require '../database.php';

require '../DAO/DAO_Usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Actualizar alumno
    $retorno = Usuarios::updateUsuario(
        $body['id_usuario'], $body['user'], $body['pass'], $body['nombre'], $body['apellido']);
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion correcta"));
		echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se actualizo el registro"));
		echo $json_string;
    }
}