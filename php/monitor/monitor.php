<?php

include "../../conexion/conexion.php";
header('Content-Type: application/json');

$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

if(isset($_GET["fecha"]))
	$fecha = "'" . $_GET["fecha"] ."'" ;
else
	$fecha = "dateadd(minute, -25, GETDATE())";
	

$query = "SELECT emergencias.*, personas.nombre, personas.direccion, personas.telefono, personas.correo FROM emergencias 
	INNER JOIN personas ON personas.persona = emergencias.persona
	WHERE fecha > ".$fecha." ORDER BY fecha asc";

$i = 1;
$resultados = [];
while($i < 60)
{
	$resultado = sqlsrv_query($conexion, $query, $params, $options);
	if ($resultado === false){
		echo json_encode(array("resultado"=>$resultados, "fecha"=>time(), "errores"=> sqlsrv_errors()));
		die();
	}

	$row_count = sqlsrv_num_rows($resultado);

	if ($row_count > 0) {
		$j = 0;
		while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC))
		{
			$j++;
			$resultados[] = $row;
		}
		break;
	}
	$i+=5;
	sleep(5);
}
date_default_timezone_set("America/Mazatlan");

if(!empty($resultados[0]["fecha"]->date))
	$fecha_final = $resultados[0]["fecha"]->date;
else
	$fecha_final = date("Y-m-d H:i:s");

echo json_encode(array("resultado"=>$resultados, "fecha"=>$fecha_final));
sqlsrv_free_stmt($resultado);
die();



die();
$query = "SELECT * FROM MonitorVisitas ()";
$params = array();
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$resultado = sqlsrv_query($conexion, $query, $params, $options);
if ($resultado === false) {
    die(print_r(sqlsrv_errors(), true));
}
$row_count = sqlsrv_num_rows($resultado);

if ($row_count > 0) {
    $tr = "";
    while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        $nombre = $row["nombre"];
        $direccion = $row["direccion"];
        $coordenadas = $row["coordenadas"];
        $token = $row["token"];
        $fecha = $row["fecha"];


           if (trim($aceptado) == "no") { // no se ha confirmado la cita medica despues de 10 min de ser asignada
            $color = "background-color: #EA8987;";
        } else {
            $color = "";
        }

        $tr .= '<tr style="' . $color . '">
                                   <td >' . $nombre . '</td>
                                   <td>' . $direccion . '</td>
                                   <td>' . $coordenadas . '</td>
                                   <td>' . $token . '</td>
                                   <td>' . $fecha . '</td>  
                                   ' . $td . '
                                   <td style="text-align:right">
                                          <a class="dropdown-button2 btn blue-grey lighten-1" href="#" data-activates="dropdown' . $emergencia . '" style="font-size:12px;height: 25px;line-height: 25px;"><i class="material-icons" style="color:#FFF">more_vert</i></a>
                                          <ul id="dropdown' . $emergencia . '" class="dropdown-content">
                                                 <li><a onclick="mapaVisitaMedica(' . $coordenadas . ',' . $emergencia . ')" style="color: #26a69a;">Mapa de la 
                                                 cita</a></li>
                                                 ' . $btn_reasignar_cita . '
                                          </ul>
                                   </td>
                              </tr>';
    }

    $tabla = ' <div class="card material-table">
                                   <div class="table-header">
                                              <span style="display:none">
                                                <i class="material-icons tooltipped" style="cursor: pointer;" onclick="enviarNotificacion()">notifications</i>
                                          </span> 
                                          <div class="actions">
                                                 <a onclick="campoBusquedaNombre()" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                                          </div>
                                   </div>
                                   <table style="font-size: 12px" class="striped" id="datatable">
                                         <thead>
                                               <tr>
                                                     <th style="width: 85px;"># Emergencia</th>
                                                     <th style="width: 110px;">Nombre</th>
                                                     <th style="width: 130px ;">Fecha</th>                                      
                                                     <th style="text-align:right;width: 108px;">Acciones</th>
                                               </tr>
                                         </thead>
                                         <tbody>
                                               ' . $tr . '                      
                                         </tbody>
                                   </table>
                            </div>
                            
                            
                            <div id="reasigna_cita" class="modal">
                                   <div class="modal-content">
                                          <h5>Reasignación de visita</h5>
                                          <div id="contenido_reasignar_citra"></div>
                                   </div>                                   
                            </div>
                            
                            <div id="modal_mapa_visita" class="modal modal-fixed-footer">
                                   <div class="modal-content">
                                          <h5>Ubicación del evento</h5>
                                          <div id="contenido_persona"></div>
                                          <div id="map_canvas" style="width:100%; height:200px"></div>
                                   </div>
                                   <div class="modal-footer">
                                          <a href="#!" class=" modal-action modal-close waves-effect grey darken-1 btn-flat" onclick="estatusTiempo()"><span class="white-text">Cerrar</span></a>
                                   </div>
                            </div>

			
                             ';


    $todo = $tabla;
} else {
    $todo = '<div class="col s12 ">
                                 <p class="z-depth-1 amber lighten-2" style="padding: 10px 10px">&nbsp;&nbsp;&nbsp;<b>No se tienen citas médicas por el momento</b></p>
                            </div>';
}
sqlsrv_free_stmt($resultado);



echo
'	<div class="row">
		<div class="col s12 m12">
			' . $todo . '
		</div>
	 </div>';
