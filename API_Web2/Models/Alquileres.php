<?php
// Clase Alquiler hereda de la clase Conectar
class Alquiler extends Conectar {

    // Obtiene todos los alquileres
    public function obtener_alquileres() {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $consulta_sql = "
        SELECT 
            a.idAlquiler, 
            a.idLibro, 
            a.idCliente, 
            a.FechaAlquiler, 
            l.Nombre AS Libro, 
            c.Nombre AS Cliente
        FROM alquileres a
        JOIN libros l ON a.idLibro = l.idLibro
        JOIN clientes c ON a.idCliente = c.idCliente";
            

        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un alquiler por su ID
    public function obtener_alquiler_por_id($idAlquiler) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $consulta_sql = "
            SELECT 
                a.idAlquiler, 
                l.Nombre AS Libro, 
                c.Nombre AS Cliente, 
                a.FechaAlquiler 
            FROM alquileres a
            JOIN libros l ON a.idLibro = l.idLibro
            JOIN clientes c ON a.idCliente = c.idCliente
            WHERE a.idAlquiler = ?";

        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $idAlquiler);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta un nuevo alquiler
    public function insertar_alquiler($idLibro, $idCliente, $fechaAlquiler) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "
            INSERT INTO alquileres (idLibro, idCliente, FechaAlquiler) 
            VALUES (?, ?, ?)";

        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $idLibro);
        $sentencia->bindValue(2, $idCliente);
        $sentencia->bindValue(3, $fechaAlquiler);
        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    // Actualiza un alquiler existente
    public function actualizar_alquiler($idAlquiler, $idLibro, $idCliente, $fechaAlquiler) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "
            UPDATE alquileres 
            SET idLibro = ?, idCliente = ?, FechaAlquiler = ? 
            WHERE idAlquiler = ?";

        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $idLibro);
        $sentencia->bindValue(2, $idCliente);
        $sentencia->bindValue(3, $fechaAlquiler);
        $sentencia->bindValue(4, $idAlquiler);
        $sentencia->execute();

        return $sentencia->rowCount();
    }

    // Elimina un alquiler
    public function eliminar_alquiler($idAlquiler) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "DELETE FROM alquileres WHERE idAlquiler = ?";

        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $idAlquiler);
        $sentencia->execute();

        return $sentencia->rowCount();
    }
}
?>
