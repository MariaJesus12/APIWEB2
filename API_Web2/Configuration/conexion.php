<?php
class Conectar {
    protected $conexion_bd;
    protected function conectar_bd() {
        try {
          
            $conexion = $this->conexion_bd = new PDO("mysql://root:bxTcLeqRPJZsNgGokCXtQtILppbmmARL@autorack.proxy.rlwy.net:13759/railway");
            return $conexion;
        } catch (Exception $e) {
            print "Error en la base de datos: " . $e->getMessage() . "<br/>";
            die();  
        }
    }
    public function establecer_codificacion() {
        return $this->conexion_bd->query("SET NAMES 'utf8'");
    }
}
?>