<html>
<head>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Emergencia</title>

    <!-- CSS  -->
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <link href="css/material_icons.css" type="text/css" rel="stylesheet"/>
    <link href="css/select2.min.css" type="text/css" rel="stylesheet"/>
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <!--     <link href="css/easy-autocomplete.themes.min.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->
    <link href="css/easy-autocomplete.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/estilo_base.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/dataTableStyle.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/pnotify.custom.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/bar-notification.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<style type="text/css">
    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        top: 10px !important;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #target {
        width: 345px;
    }

    .estilo_bagde {
        background-color: #C71212 !important;
        border-radius: 14px !important;
        font-weight: bold !important;
        padding: 4px 4px !important;
        font-size: 13px !important;
    }

    .estiloNotificacion {
        margin-top: 32px;

        cursor: pointer
    }
	
@-webkit-keyframes shake {
  from, to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translate3d(-10px, 0, 0);
    transform: translate3d(-10px, 0, 0);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translate3d(10px, 0, 0);
    transform: translate3d(10px, 0, 0);
  }
}

@keyframes shake {
  from, to {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
  }

  10%, 30%, 50%, 70%, 90% {
    -webkit-transform: translate3d(-10px, 0, 0);
    transform: translate3d(-10px, 0, 0);
  }

  20%, 40%, 60%, 80% {
    -webkit-transform: translate3d(10px, 0, 0);
    transform: translate3d(10px, 0, 0);
  }
}

.shake {
  -webkit-animation-name: shake;
  animation-name: shake;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}
	
</style>
<body>
<nav class="top-nav " id="nav">
    <div class="nav-wrapper red accent-4">

        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu "></i></a>
        <!-- <span style="float:left;margin-left:15px;font-size: 20px;" id="titulo_modulo"></span>-->


        <div id="notificationContainer">
            <div id="notificationTitle" style="color:#333;line-height: 20px;">
                Notificaciones
            </div>
            <div id="notificationsBody" class="notifications" style=" color: #333;"></div>
        </div>
        </ul>

        <!--ul class="side-nav fixed white" id="mobile-demo">
            <div align="center" style="margin-top:10px" ><img class="resposive-img " style="width: 55%" src="img/logoEnGrande.png"/>
            </div>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion" id="contenido_menu">
                </ul>
            </li>
        </ul-->
    </div>
</nav>
<div id="contenido" class="container">
<div class="card material-table">

	<table style="font-size: 12px" class="striped" id="datatable">
		<thead>
			   <tr>
					<th style="width: 55px;text-align:center">Emergencia</th>
					<th style="width: 50px;text-align:center">Tipo</th>
					<th style="width: 85px;text-align:center">Información</th>  
					<th style="width: 85px;text-align:center">Fecha</th>  
                                  
					<th style="width: 85px; text-align:center">Acciones</th>
			   </tr>
		</thead>
		<tbody class="collection">
			
		</tbody>
	</table>
</div>

</div>


</body>
</header>
<!-- Modal Structure -->
<div id="alerta" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h5>Mapa</h5>
        <p id="contenido_alerta">
		<div id="directionsPanel"></div><div id="map-canvas"></div>
		</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect green lighten-1 btn-flat"><span class="white-text">Aceptar</span></a>
    </div>
</div>

<div id="modal_confirm" class="modal">
    <div class="modal-content">
        <h5>Escribe el mensaje para notificar al usuario.</h5>
        <div id="contenido_confirm" style="font-size: 15px;">
			<Textarea class="mensaje_notificacion" placeholder="Escribe el mensaje para el usuario">Recibimos tu emergencia, en un momento serás atendido.</textarea>
		</div>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect green darken-1 btn-flat" id="acepta_confirm"><span
                class="white-text">Notificar</span></a>
        <a href="#!" class=" modal-action modal-close waves-effect grey darken-1 btn-flat"
           style="margin-right: 15px"><span class="white-text">Cancelar</span></a>
    </div>
</div>

<div id="modal_datos_usuario" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h5>Mi cuenta</h5>
        <hr>
        <div id="contenido_configuracion_cuenta"></div>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect grey darken-1 btn-flat"><span class="white-text">Cerrar</span></a>
    </div>
</div>

</body>
</html>
<script src="js/jQuery2.1.1.js"></script>
<script src='http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
<script src="js/select2.full.min.js"></script>
<script src="js/ejs.js"></script>
<script
    src="//maps.googleapis.com/maps/api/js?key=AIzaSyC89Uib1cmhWlZO9P0HYhPyzX6m0VN9Hiw&v=3.exp&sensor=true&region=GB"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/maps.js"></script>

<script>

	var emergencias = [];

	function enviar_notificacion(id, tipo, emergencia)
	{	
	
		$.ajax({
            url: "php/notificar/index.php?usuario=" + id + "&tipo=" + tipo + "&emergencia=" + emergencia,
            type: "POST",
            data: {"mensaje": $(".mensaje_notificacion").val()},
            success: (function (json) {
				$(".id_" + emergencia).addClass("blue lighten-4");
				alert("Mensaje enviado...");
            })
        });
	
	}
	
	function atender(id,tipo,emergencia)
	{
		$("#modal_confirm").openModal();
		$("#acepta_confirm").attr("onclick", "enviar_notificacion("+id+",'"+tipo+"',"+emergencia+")");
	}
	
	function ubicacion(coordenadas)
	{
		array_coordenadas = coordenadas.split(",");
		console.log(array_coordenadas);
		console.log(array_coordenadas.lenght);
		
		
		if(array_coordenadas.length>1)
		{
			$('#alerta').openModal();
		
			console.log(array_coordenadas);
			
			Emergencia.center = new google.maps.LatLng(array_coordenadas[0], array_coordenadas[1]);
			Emergencia.addInfoMarkers([[array_coordenadas[0], array_coordenadas[1],"","","Ubicación",""]]);
			Emergencia.map.setCenter(Emergencia.center);
			Emergencia.howToGet(array_coordenadas[0],array_coordenadas[1]);
		}else
		{
			alert("No se recibieron coordenadas.");
		}
			
	}
	
	function buscarRegistros(fecha)
	{
		 $.ajax({
            url: "php/monitor/monitor.php?fecha=" + fecha,
            type: "POST",
            data: {accion: "muestraMonitorCitasMedicas"},
            success: (function (json) {

				buscarRegistros(json.fecha);
				
				$.each( json["resultado"], function( key, value ) {
					
					if(typeof emergencias[value["emergencia"]] == "undefined")
					{			
						html = new EJS({url: 'vistas/monitor.html'}).render(value)
						$("#contenido .collection").prepend(html);
						emergencias[value["emergencia"]] = 1;
						Materialize.toast('Llego una emergencia.', 3000, 'rounded');
					}
				})
            })
        });
	}

    function muestraMonitor() {
        bandera = false;
        $.ajax({
            url: "php/monitor/monitor.php",
            type: "POST",
			dataType: "json",
            data: {accion: "muestraMonitorCitasMedicas"},
            success: (function (json) {
				buscarRegistros(json["fecha"]);
				console.log(json["fecha"]);
				
				$.each( json["resultado"], function( key, value ) {
					html = new EJS({url: 'vistas/monitor.html'}).render(value)
					$("#contenido  .collection").prepend(html);
				});
				
            })
        });
    }
	

	
    $(document).ready(function () {
        muestraMonitor();
    });
</script>
