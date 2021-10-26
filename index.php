<?php 

  //MEJORA DE API
  //API: V1.2

  require_once("./config.php"); //Class CxContacto
  require_once("./Contacto.php"); //Class Contacto
  require_once("./helpers.php"); //$respuestas[]
  
  //['MIS VARIABLES']
  $contactos = [];
  $cxContacto = new CxContacto();

  //@POST(http://localhost/ws_app/')
  if($_POST){
    if(isset($_POST['accion'])){
      $accion = $_POST['accion']; 
      switch($accion){
        case 'agregar':
          $rs = $cxContacto->agregar($_POST['nombre'], $_POST['telefono']);
          if($rs) echo json_encode($respuestas["agregar"]["ok"]);
          else echo json_encode($respuestas['agregar']['error']);
          break;
        case 'actualizar':
          $rs = $cxContacto->actualizar($_POST['id'], $_POST['nombre'], $_POST['telefono'] );
          if($rs) echo json_encode($respuestas["actualizar"]["ok"]);
          else echo json_encode($respuestas['actualizar']['error']);
          break;
        case 'eliminar':
          $rs = $cxContacto->eliminar($_POST['id']);
          if($rs) echo json_encode($respuestas["eliminar"]["ok"]);
          else echo json_encode($respuestas['eliminar']['error']);
          break;
      }
    }
  }
  //@GET('http://localhost/ws_app/')
  else if($_GET){ //OBTENER CONTACTO POR ID
    if($_GET['accion'] == 'obtener'){
      $contactos = $cxContacto->get($_GET['id']);
      echo json_encode($contactos);
    }
  }else{ //OBTENER TODOS LOS CONTACTOS
    $contactos = $cxContacto->todos();
    echo json_encode($contactos);
  }

  /* function get(){
    global $contactos;
    echo json_encode($contactos);
  } */

?>