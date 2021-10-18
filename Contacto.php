<?php 

  class Contacto {

      public int $id;
      public string $nombre;
      public string $telefono;

      public function __construct(int $id, string $nombre, string $telefono){
          $this->id = $id;
          $this->nombre = $nombre;
          $this->telefono = $telefono;
      }


  }


?>