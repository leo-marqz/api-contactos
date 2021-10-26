<?php 
  
  require_once("./config.php");

  class Contacto {

      public int $id;
      public string $nombre;
      public string $telefono;

      public function __construct($id, $nombre, $telefono){
          $this->id = $id;
          $this->nombre = $nombre;
          $this->telefono = $telefono;
      }
    }
?>
