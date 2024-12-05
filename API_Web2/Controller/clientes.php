<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // Responde con 200 OK para las solicitudes OPTIONS
    exit;
}
header("Content-Type: application/json");

require_once("../Configuration/conexion.php");
require_once("../Models/Clientes.php");

$cliente = new Cliente();
$body = json_decode(file_get_contents("php://input"), true);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        // Obtener todos los clientes o uno por ID
        if (isset($_GET['idCliente'])) {
            $datos = $cliente->obtener_cliente_por_id($_GET['idCliente']);
        } else {
            $datos = $cliente->obtener_clientes();
        }
        echo json_encode($datos);
        break;

    case "POST":
        // Insertar un cliente nuevo
        $datos = $cliente->insertar_cliente($body["Nombre"], $body["Correo"], $body["Telefono"]);
        echo json_encode(["Correcto" => "Cliente Insertado", "idCliente" => $datos]);
        break;

    case "PUT":
        // Actualizar un cliente existente
        $datos = $cliente->actualizar_cliente($body["idCliente"], $body["Nombre"], $body["Correo"], $body["Telefono"]);
        echo json_encode(["Correcto" => "Cliente Actualizado"]);
        break;

    case "DELETE":
        // Eliminar un cliente
        $datos = $cliente->eliminar_cliente($body["idCliente"]);
        echo json_encode(["Correcto" => "Cliente Eliminado"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["Error" => "Método no permitido"]);
        break;
}
?>
