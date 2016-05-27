<?php

include "../../conexion/conexion.php";
header('Content-Type: application/json');

//////////////////////////////////////////////////////////////////////////////////////////////////////////	
//Funcion para enviar notificaciones push a android;
function enviaAndroid($gcm,$mensaje){

	$headers = array("Content-Type:application/json", "Authorization:key=AIzaSyDt4DN2KSg_ums8epf87VRWcDPD9HX1mjo");

	$data = array(
		'data' => array(
			"msg"=> $mensaje , 
			"id"=>$_GET["emergencia"]),
		'registration_ids' => array($gcm)
	);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}

$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);


/*
UPDATE table_name
SET column1=value, column2=value2,...
WHERE some_column=some_value 
*/

$query = "UPDATE emergencias SET estatus = 'aceptado' where emergencia = ".$_GET["emergencia"];
$resultado = sqlsrv_query($conexion, $query, $params, $options);

$query = "SELECT token FROM personas where persona = ".$_GET["usuario"];
$resultado = sqlsrv_query($conexion, $query, $params, $options);

if ($resultado === false){
	echo json_encode(array("errores"=> sqlsrv_errors(), "query" => $query));
	die();
}

$row_count = sqlsrv_num_rows($resultado);

if ($row_count > 0) {
	$j = 0;
	$row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);
	
	echo json_encode(array(enviaAndroid($row["token"],$_POST["mensaje"]),$row["token"]));
	
	die();
	
}