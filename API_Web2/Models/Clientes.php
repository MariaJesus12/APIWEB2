<?php
// Clase Cliente hereda de la clase Conectar
class Cliente extends Conectar {

    // Obtiene todos los clientes
    public function obtener_clientes() {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $consulta_sql = "SELECT * FROM clientes";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene un cliente por su ID
    public function obtener_cliente_por_id($idCliente) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $consulta_sql = "SELECT * FROM clientes WHERE idCliente = ?";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $idCliente);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta un nuevo cliente
    public function insertar_cliente($nombre, $correo, $telefono) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "INSERT INTO clientes (Nombre, Correo, Telefono) VALUES (?, ?, ?)";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);
        $sentencia->bindValue(2, $correo);
        $sentencia->bindValue(3, $telefono);
        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    // Actualiza un cliente existente
    public function actualizar_cliente($idCliente, $nombre, $correo, $telefono) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "UPDATE clientes SET Nombre = ?, Correo = ?, Telefono = ? WHERE idCliente = ?";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);
        $sentencia->bindValue(2, $correo);
        $sentencia->bindValue(3, $telefono);
        $sentencia->bindValue(4, $idCliente);
        $sentencia->execute();

        return $sentencia->rowCount();
    }

    // Elimina un cliente
    public function eliminar_cliente($idCliente) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "DELETE FROM clientes WHERE idCliente = ?";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $idCliente);
        $sentencia->execute();

        return $sentencia->rowCount();
    }
}
?>

