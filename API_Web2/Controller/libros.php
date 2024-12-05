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
// Establece el tipo de contenido a JSON
header("Content-Type: application/json");

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Libros
require_once("../Configuration/conexion.php");
require_once("../Models//Libros.php");

// Crea una instancia de la clase Libros
$libro = new Libros();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Obtén el método HTTP utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Define las operaciones basadas en el método HTTP
switch ($method) {

    // Manejo para obtener todos los libros (GET)
    case "GET":
        $datos = $libro->obtener_libros();
        echo json_encode($datos);
        break;

    // Manejo para insertar un nuevo libro (POST)
    case "POST":
        $datos = $libro->insertar_libro($body["Nombre"], $body["Autor"], $body["Anio"]);
        echo json_encode(["Correcto" => "Libro Insertado"]);
        break;

    // Manejo para actualizar un libro (PUT)
    case "PUT":
        $datos = $libro->actualizar_libro($body["idLibro"], $body["Nombre"], $body["Autor"], $body["Anio"]);
        echo json_encode(["Correcto" => "Libro Actualizado"]);
        break;

    // Manejo para eliminar un libro (DELETE)
    case "DELETE":
        $datos = $libro->eliminar_libro($body["idLibro"]);
        echo json_encode(["Correcto" => "Libro Eliminado"]);
        break;

    // Manejo para métodos no soportados
    default:
        http_response_code(405);
        echo json_encode(["Error" => "Método no permitido"]);
        break;
}
?>
