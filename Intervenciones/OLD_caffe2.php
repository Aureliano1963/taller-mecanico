<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

$localID=$_SESSION['id'];
$timezone = new DateTimeZone('Europe/Madrid');
$data = new DateTime('now', $timezone);

//Parametros configuracion bbdd

  //Si se accede a la pagina sin parametros en URL
  if(empty($_GET['t'])){
      header('Location:../WEB_PRINCIPAL.php'); 
  }else{
      $time= $_GET['t'];
      // select TIME_TO_SEC(TIME(NOW())) as hora
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
    
      #Actualizar un usuario a la base de datos
      $sql="INSERT INTO intervencion (horaIn,estado,idMec,tipo,title) VALUES ('".$data->format('Y-m-d H:i:s')."','en curso','".$localID."','cafe','".$_GET['t']."' )";
      mysqli_query($conexio, $sql);
      mysqli_close($conexio);      
      header('Location:../WEB_PRINCIPAL.php'); 
  }
?>