<?php
class Conectar {
    protected $conexion_bd;
    protected function conectar_bd() {
        try {
            $DB_HOST=$_ENV["DB_HOST"];
            $DB_USER=$_ENV["DB_USER"];
            $DB_PASSWORD=$_ENV["DB_PASSWORD"];
            $DB_NAME=$_ENV["DB_NAME"];
            $DB_PORT=$_ENV["DB_PORT"];
            
           
          

            $conexion = $this->conexion_bd = new PDO("$DB_HOST","$DB_USER","$DB_PASSWORD","$DB_NAME","$DB_PORT");
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