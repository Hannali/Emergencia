<?php
include '../conexion/conexion.php';
$query = "SELECT p.nombre,p.direccion,p.token,e.coordenadas,e.fecha FROM personas p
          INNER JOIN emergencias e ON p.persona = e.persona";
$resultado = sqlsrv_query($conexion, $query);
if ($resultado === false) {
    die(print_r(sqlsrv_errors(), true));
}
$tr = "";
while ($row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
    $nombre = $row["nombre"];
    $direccion = $row["direccion"];
    $fechaRegistro = $row["fecha"];
    $token = $row["token"];
    $coordenadas = $row["coordenadas"];


    $td = '<td style="text-align:center"><i class="material-icons tiny">radio_button_unchecked</i></td>
<td style="text-align:center"><i class="material-icons tiny">radio_button_unchecked</i></td>
<td style="text-align:center"><i class="material-icons tiny">radio_button_unchecked</i></td>
<td style="text-align:center"><i class="material-icons tiny">radio_button_unchecked</i></td>
<td style="text-align:center"><i class="material-icons tiny">radio_button_unchecked</i></td>';
    $btn_reasignar_cita = '<li><a onclick="confirmaReasignaCita(' . $token . ')" style="color: #26a69a;">Reasignar cita</a></li>';
    $tr .= '<tr style="' . $color . '">
    <td >' . $nombre . '</td>
    <td>' . $direccion . '</td>
    <td>' . $fechaRegistro . '</td>
    ' . $td . '
    <td style="text-align:right">
        <a class="dropdown-button2 btn blue-grey lighten-1" href="#" data-activates="dropdown' . $visita . '" style="font-size:12px;height: 25px;line-height: 25px;"><i class="material-icons" style="color:#FFF">more_vert</i></a>
        <ul id="dropdown' . $visita . '" class="dropdown-content">
            <li><a onclick="mapaVisitaMedica(' . $coordenadas . ')" style="color: #26a69a;">Mapa de la
                    cita</a></li>
            ' . $btn_reasignar_cita . '
        </ul>
    </td>
</tr>';
}
$tabla = '
<div class="card material-table">
    <div class="table-header">
        <span class="table-title" id="tiempo" style="display: none"></span>
        <span style="font-size: 16px;">Actualización:&nbsp;&nbsp;</span>
        <div class="progress" style="width:300px;margin-top: 14px;">
            <div class="determinate" id="barra_progreso" style="width: 0%"></div>
        </div>
        &nbsp;&nbsp;
                                          <span id="iconoReloj" onclick="estatusTiempo()" >
                                                <i class="material-icons" style="cursor: pointer;">pause_circle_outline</i>
                                          </span>
                                          <span >
                                                <i class="material-icons tooltipped" style="cursor: pointer;" title="Actualizar"onclick="muestraMonitorCitasMedicas()">loop</i>
                                          </span> 
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
            <th style="width: 85px;"># Cita</th>
            <th>Médico</th>
            <th>Paciente</th>
            <th style="width: 110px;">Nombre</th>
            <th style="width: 130px ;">Dirección</th>
            <th style="text-align:center;width: 80px;">Registrado</th>
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
</div>';
echo 'entre';
echo $todo = $tabla;
