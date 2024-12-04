<?php

header("Content-Type: application/json");

require_once("../Configuration/conexion.php");
require_once("../Models/Alquileres.php");

$alquiler = new Alquiler();
$body = json_decode(file_get_contents("php://input"), true);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        // Obtener todos los alquileres o uno por ID
        if (isset($_GET['idAlquiler'])) {
            $datos = $alquiler->obtener_alquiler_por_id($_GET['idAlquiler']);
        } else {
            $datos = $alquiler->obtener_alquileres();
        }
        echo json_encode($datos);
        break;

    case "POST":
        // Insertar un nuevo alquiler
        $datos = $alquiler->insertar_alquiler(
            $body["idLibro"], 
            $body["idCliente"], 
            $body["FechaAlquiler"]
        );
        echo json_encode(["Correcto" => "Alquiler Insertado", "idAlquiler" => $datos]);
        break;

    case "PUT":
        // Actualizar un alquiler existente
        $datos = $alquiler->actualizar_alquiler(
            $body["idAlquiler"], 
            $body["idLibro"], 
            $body["idCliente"], 
            $body["FechaAlquiler"]
        );
        echo json_encode(["Correcto" => "Alquiler Actualizado"]);
        break;

    case "DELETE":
        // Eliminar un alquiler
        $datos = $alquiler->eliminar_alquiler($body["idAlquiler"]);
        echo json_encode(["Correcto" => "Alquiler Eliminado"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["Error" => "Método no permitido"]);
        break;
}
?>
