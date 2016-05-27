<?php

$servidor = '216.98.144.70\SQLEXPRESS';
$USUARIO = 'sa';
$CONTRASENA = 'sa';
$BASEDATOS = 'emergencia';


//Realizamos la configuracion de la conexion con las credenciales de la instancia de SQL
$datosConexion = array("Database" => $BASEDATOS, "UID" => $USUARIO, "PWD" => $CONTRASENA, "CharacterSet"=>"UTF-8");
$conexion = sqlsrv_connect($servidor, $datosConexion);
//comprobacion de la conexion
if (!$conexion) {
  echo "La conexión no se pudo establecer conexion";
  die(print_r(sqlsrv_errors(), true));
}
?>
