<?php
// include db connect class
include '../../conexion/conexion.php';

if (isset($_GET['nombre'])) {

    $nombre = $_GET['nombre'];
    $direccion = $_GET['direccion'];
    $telefono = $_GET['telefono'];
    $correo = $_GET['correo'];
	$token = $_GET['token'];
	$parametros = array($nombre, $direccion, $telefono,  $correo,$token);
    $query = "execute GuardarPersona ?,?,?,?,?";
    $resultado = sqlsrv_query($conexion, $query,$parametros);
    if ($resultado === false) {
           die(print_r(sqlsrv_errors(), true));
       }
       while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_NUMERIC)) {
           $id = $row[0];
       }
    sqlsrv_free_stmt($resultado);

    echo json_encode(array("resultado" => $id));

} else {
    $result["resultado"] = "0";
    echo json_encode($result);
}
