<?php

require_once("./Contacto.php");

Class CxContacto {

    private $conexion;

    public function __construct(){
        $this->conexion = new mysqli("localhost", "root", "", "miagenda");
        if($this->conexion->connect_errno){
            echo "Fallo al conectar : " . $this->conexion->connect_error;
            die("Sos un error jajaja");
        }
    }
    
    public function todos(){
        $contactos = [];
        try {
            $consulta = "SELECT * FROM contactos";
            $respuesta = $this->conexion->query($consulta);
            if($respuesta->num_rows > 0){
                while($c = mysqli_fetch_array($respuesta, MYSQLI_ASSOC)){
                    $contacto = new Contacto($c['id_contacto'], $c['nombre'], $c['telefono']);
                    array_push($contactos, $contacto);
                }
            }
        }catch(Exception $e){
          die($e->getMessage());
        }finally{
            $respuesta->close();
            $this->conexion->close();
        }
        return $contactos;
      }

      public function get($id){
        $contactos = [];
        try {
            $consulta = "SELECT * FROM contactos WHERE id_contacto='$id' ";
            $respuesta = $this->conexion->query($consulta);
            if($respuesta->num_rows > 0){
                while($c = mysqli_fetch_array($respuesta, MYSQLI_ASSOC)){
                    $contacto = new Contacto($c['id_contacto'], $c['nombre'], $c['telefono']);
                    array_push($contactos, $contacto);
                }
            }
        }catch(Exception $e){
          die($e->getMessage());
        }finally{
            $respuesta->close();
            $this->conexion->close();
        }
        return $contactos;
      }

      public function agregar($nombre, $telefono){
        $resultado = false;
        try {
            $consulta = "INSERT INTO contactos (nombre, telefono) VALUES ('$nombre', '$telefono')";
            $this->conexion->query($consulta);
            $resultado = true;
        }catch(Exception $e){
          $resultado = false;
        }finally{
          $this->conexion->close();
        }
        return $resultado;
      }

      public function actualizar($id, $nombre, $telefono){
          $resultado = false;
          try {
              $consulta = "UPDATE contactos SET nombre='$nombre', telefono='$telefono' WHERE id_contacto='$id' ";
              $this->conexion->query($consulta);
              $resultado = true;
          }catch(Exception $e){
            $resultado = false;
          }finally{
            $this->conexion->close();
          }
          return $resultado;
      }

      public function eliminar($id){
        $resultado = false;
          try {
              $consulta = "DELETE FROM contactos WHERE id_contacto='$id' ";
              $this->conexion->query($consulta);
              $resultado = true;
          }catch(Exception $e){
            $resultado = false;
          }finally{
            $this->conexion->close();
          }
          return $resultado;
      }
    
}

?>