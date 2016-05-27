//funcion para mandar llmar la interfaz de registro de permisos
function muestraModulo(modulo){
	
	switch(modulo) {

		case 1:
                     resetTiempo(); //detener la barra de progreso del monitor de citas medicas
			$.ajax({
				url:"php/usuarios/usuarios.php",
				type:"POST",
				data:{accion:"formulario", modulo:modulo},
				success:(function(html){
					var info = html.split("|");
					if( info[1] == 0){
						alerta("No tienes acceso a este módulo.");
						obtenerMenu();
						return;
					}

					$("#titulo_modulo").html("Registro de usuarios");
					$("#contenido").html(info[0]);

                                   $(".select").material_select();
                                   $("#ciudad").select2();
                                   $("#colonia").select2();
                                   $("#cp").select2();
                                   $('.datepicker').pickadate({
                                          selectMonths: true, // Creates a dropdown to control month
                                          selectYears: 50, // Creates a dropdown of 15 years to control year
                                          format: 'yyyy-mm-dd',
                                   });
				})
			});
			break;

		case 2:
                     resetTiempo(); //detener la barra de progreso del monitor de citas medicas
			$.ajax({
				url:"php/usuarios/usuarios.php",
				type:"POST",
				data:{accion:"formularioActualizaUsuarios", modulo:modulo},
				success:(function(html){
					var info = html.split("|");
					if( info[1] == 0){
						alerta("No tienes acceso a este módulo.");
						obtenerMenu();
						return;
					}

					$("#titulo_modulo").html("Actualizar datos de usuario");
					$("#contenido").html(info[0]);

                                   //autocomplete por personas
                                    var options = {
                                           url: function(phrase) { return "php/phpAutocomplete/busquedaUsuarios.php"; },
                                           getValue: function(element) {  return element.nombreUsuario;  },
                                           ajaxSettings: { dataType: "json", method: "POST",  data: {     dataType: "json" } },
                                           preparePostData: function(data) { data.phrase = $("#busqueda_usuario").val();  return data; },
                                           list: {
                                                  onChooseEvent: function() {
                                                         var value = $("#busqueda_usuario").getSelectedItemData().usuario;
                                                         verDatosActualizarUsuario(value);
                                                         $("#busqueda_usuario").val("");
                                                  },
                                                 maxNumberOfElements: 10,
                                                 match: { enabled: true }
                                           },
                                    };
                                    $("#busqueda_usuario").easyAutocomplete(options);
				})
			});
			break;
		case 3:
                     resetTiempo(); //detener la barra de progreso del monitor de citas medicas
			$.ajax({
				url:"php/polizas/polizas.php",
				type:"POST",
				data:{accion:"formulario", modulo:modulo},
				success:(function(html){
					var info = html.split("|");
					if( info[1] == 0){
						alerta("No tienes acceso a este módulo.");
						obtenerMenu();						
						return;
					}

					$("#titulo_modulo").html("Pólizas médicas");
					$("#contenido").html(info[0]);
					buscarPóliza(); //funcion para mostrar lainterfaz de busqueda de polizas							
				})
			});
			break;
              case 4:
                     resetTiempo(); //detener la barra de progreso del monitor de citas medicas
                     $.ajax({
                            url:"php/registroEventos/registroEventos.php",
                            type:"POST",
                            data:{accion:"formulario", modulo:modulo},
                            success:(function(html){
                                   var info = html.split("||");
                                   if( info[1] == 0){
                                          alerta("No tienes acceso a este módulo.");
                                          obtenerMenu();
                                          return;
                                   }

                                   $("#titulo_modulo").html("Registro de eventos");
                                   $("#contenido").html(info[0]);
                                   $('#tabla_eventos').dataTable({
                                          "oLanguage": {
                                                 "sStripClasses": "",
                                                 "sSearch": "",
                                                 "sSearchPlaceholder": "Ingresa un texto de búsqueda",
                                                 "sInfo": "_START_ -_END_ of _TOTAL_",
                                                 "sLengthMenu": '<span>Registros por página:</span><select class="browser-default">' +
                                                 '<option value="10">10</option>' +
                                                 '<option value="20">20</option>' +
                                                 '<option value="30">30</option>' +
                                                 '<option value="40">40</option>' +
                                                 '<option value="50">50</option>' +
                                                 '<option value="-1">All</option>' +
                                                 '</select></div>'
                                          },
                                          bAutoWidth: false
                                   });

                            })
                     });
                     break;

		case 5:
                     resetTiempo(); //detener la barra de progreso del monitor de citas medicas
			$.ajax({
				url:"php/visitas/visitas.php",
				type:"POST",
				data:{accion:"formulario", modulo:modulo},
				success:(function(html){
					var info = html.split("|");
					if( info[1] == 0){
						alerta("No tienes acceso a este módulo.");
						obtenerMenu();
						return;
					}

					$("#titulo_modulo").html("Programar visitas");
					$("#contenido").html(info[0]);
					$("#medico").select2();
					$('ul.tabs').tabs(); //activar los tabs	
					generarVisitaLlamada();	
						
				})
			});
			break;

		case 7:
			resetTiempo(); //detener la barra de progreso del monitor de citas medicas
			$.ajax({
				url:"php/quieroAfiliarme/quieroAfiliarme.php",
				type:"POST",
				data:{accion:"formulario", modulo:modulo},
				success:(function(html){
					var info = html.split("|");
					if( info[1] == 0){
						alerta("No tienes acceso a este módulo.");
						obtenerMenu();
						return;
					}

					$("#titulo_modulo").html("Prospectos");
					$("#contenido").html(info[0]);
                                   $(".select").material_select();
                                   $('#datatable').dataTable({
                                          "oLanguage": {
                                                 "sStripClasses": "",
                                                 "sSearch": "",
                                                 "sSearchPlaceholder": "Ingresa un texto de búsqueda",
                                                 "sInfo": "_START_ -_END_ of _TOTAL_",
                                                 "sLengthMenu": '<span>Registros por página:</span><select class="browser-default">' +
                                                 '<option value="10">10</option>' +
                                                 '<option value="20">20</option>' +
                                                 '<option value="30">30</option>' +
                                                 '<option value="40">40</option>' +
                                                 '<option value="50">50</option>' +
                                                 '<option value="-1">All</option>' +
                                                 '</select></div>'
                                          },
                                          bAutoWidth: false
                                   });
                                   $('.dropdown-button2').dropdown({
                                          inDuration: 300,
                                          outDuration: 225,
                                          constrain_width: false, // Does not change width of dropdown to that of the activator
                                          hover: false, // Activate on hover
                                          gutter: 0, // Spacing from edge
                                          belowOrigin: false, // Displays dropdown below the button
                                          alignment: 'right' // Displays dropdown with edge aligned to the left of button
                                   });

				})
			});
			break;

	}
}
