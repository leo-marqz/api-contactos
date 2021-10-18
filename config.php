<?php

Class Conexion {
    
    public static function getConexion(){
        $con = new mysqli("localhost", "root", "", "miagenda");
        if($con->connect_errno){
            echo "Fallo al conectar : " . $con->connect_error;
            die("Sos un error jajaja");
        }
        return $con;
    }
}

?>