<?php
// include db connect class
include '../../conexion/conexion.php';

if (isset($_GET['persona'])) {

    $persona = $_GET['persona'];
    $tipo = $_GET['tipo'];
    $coordenadas = $_GET['coordenadas'];
	$parametros = array($persona, $tipo, $coordenadas);
    $query = "execute GuardarEmergencia ?,?,?";
    $resultado = sqlsrv_query($conexion, $query,$parametros);
    if ($resultado === false) {
           die(print_r(sqlsrv_errors(), true));
       }
       while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_NUMERIC)) {
           $resultado = $row[0];
       }
    sqlsrv_free_stmt($resultado);

    echo json_encode(array("resultado" => $resultado));

} else {
    $result["resultado"] = "No se recibió parámetro";
    echo json_encode($result);
}
