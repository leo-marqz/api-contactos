<?php 

  require_once("./config.php");
  require_once("./Contacto.php");
  
  //['MIS VARIABLES']
  $con = Conexion::getConexion();
  $contactos = [];
  $idContacto = null;
  $nombre = null;
  $telefono = null;
  $consulta = null;
  $resultado = null;

  //@GET('http://localhost/ws_app/')
  if($_GET){
    //OBTENER CONTACTO POR ID
    if($_GET['accion'] == 'obtener'){
      $idContacto = $_GET['id'];
      $consulta = "SELECT * FROM contactos WHERE id_contacto = '$idContacto'";
      $resultado = $con->query($consulta);
      while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $contacto = new Contacto($fila['id_contacto'], $fila['nombre'], $fila['telefono']);
        array_push($contactos, $contacto);
      }
    }
  }else{
    //OBTENER TODOS LOS CONTACTOS
    $resultado = $con->query("SELECT * FROM contactos");
  
    while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
      $contacto = new Contacto($fila['id_contacto'], $fila['nombre'], $fila['telefono']);
      array_push($contactos, $contacto);
    }
  }


  /* print_r($contactos); */
  /* var_dump($contactos); */

  //@POST(http://localhost/ws_app/')
  if($_POST){
    if(isset($_POST['accion'])){
      $accion = $_POST['accion'];

      switch($accion){

        //AGREGAR CONTACTO
        case 'agregar':
          $nombre = $_POST['nombre'];
          $telefono = $_POST['telefono'];
          $consulta = "INSERT INTO contactos (nombre, telefono) VALUES ('$nombre', '$telefono')";
          $con->query($consulta);

          $contactos['test'] = "agregar";
          break;

        //ACTUALIZAR CONTACTO
        case 'actualizar':
          $idContacto = $_POST['id'];
          $nombre = $_POST['nombre'];
          $telefono = $_POST['telefono'];
          $consulta = "UPDATE contactos SET nombre = '$nombre', telefono = '$telefono' WHERE id_contacto = '$idContacto'";
          $con->query($consulta);

          $contactos['test'] = "actualizar";
          break;

        //ELIMINAR CONTACTO
        case 'eliminar':
          $idContacto = $_POST['id'];
          $consulta = "DELETE FROM contactos WHERE id_contacto = '$idContacto'";
          $con->query($consulta);
          $contactos['test'] = "eliminar";
          break;

      }

    }
  }

  echo json_encode($contactos);





?>