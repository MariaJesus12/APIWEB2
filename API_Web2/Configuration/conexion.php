<?php
class Conectar {
    protected $conexion_bd;
    protected function conectar_bd() {
        try {
          $conexion=$this->conexion_bd=new PDO(
            "mysql:host=mysql.railway.internal;port=3306;dbname=railway",
            "root",
            "bxTcLeqRPJZsNgGokCXtQtILppbmmARL"
          );
        $this->conexion_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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