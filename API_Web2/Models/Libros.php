<?php
// Clase Libros hereda de la clase Conectar
class Libros extends Conectar {

    // Obtiene todos los libros
    public function obtener_libros() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        // Consulta SQL para obtener todos los libros
        $consulta_sql = "SELECT * FROM libros";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un libro específico por su ID
    public function obtener_libro_por_id($idLibro) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        // Consulta SQL para obtener un libro específico
        $consulta_sql = "SELECT * FROM libros WHERE idLibro = ?";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $idLibro); // Asocia el valor del ID del libro

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta un nuevo libro
    public function insertar_libro($nombre, $autor, $anio) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        // Sentencia SQL para insertar un nuevo libro
        $sentencia_sql = "INSERT INTO libros (Nombre, Autor, Anio) VALUES (?, ?, ?)";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre); // Asocia el nombre del libro
        $sentencia->bindValue(2, $autor);  // Asocia el autor
        $sentencia->bindValue(3, $anio);   // Asocia el año de publicación

        // Ejecuta la sentencia
        $sentencia->execute();

        // Devuelve el ID generado para el nuevo libro
        return $conexion->lastInsertId();
    }

    // Actualiza un libro existente
    public function actualizar_libro($idLibro, $nombre, $autor, $anio) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        // Sentencia SQL para actualizar un libro
        $sentencia_sql = "UPDATE libros SET Nombre = ?, Autor = ?, Anio = ? WHERE idLibro = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);   // Asocia el nombre del libro
        $sentencia->bindValue(2, $autor);    // Asocia el autor
        $sentencia->bindValue(3, $anio);     // Asocia el año de publicación
        $sentencia->bindValue(4, $idLibro);  // Asocia el ID del libro

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el número de filas afectadas
        return $sentencia->rowCount();
    }

    // Elimina un libro (eliminación física)
    public function eliminar_libro($idLibro) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        // Sentencia SQL para eliminar un libro
        $sentencia_sql = "DELETE FROM libros WHERE idLibro = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $idLibro); // Asocia el ID del libro

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el número de filas afectadas
        return $sentencia->rowCount();
    }
}
?>
