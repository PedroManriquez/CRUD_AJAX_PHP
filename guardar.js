

$('#form-ingreso').submit(function(event){
	event.preventDefault();

	$.post('save.php',
		$('#form-ingreso').serialize(),
			function(dato){
				if(dato.exito){
					var variable="";
					if(dato.cargo == 12) variable="Jefe Proyecto";
					if(dato.cargo == 23) variable="Analista";
					if(dato.cargo == 32) variable="Desarrollador";


					$('#tabla-registro tr:last').after(
		                     '<tr id="fila_'+dato.rut+'">'+
			                     '<td>'+dato.rut+'</td>'+
			                     '<td>'+dato.nombre+'</td>'+
			                     '<td>'+dato.email+'</td>'+
			                     '<td>'+dato.telefono+'</td>'+
			                     '<td>'+variable+'</td>'+
								 '<td> <button value=\''+dato.rut+'\' type="button" class="btn btn-info btn-lg boton" data-toggle="modal" data-target="#myModal">Actualizar</button> - <a id="eliminar" onclick="eliminar( \''+dato.rut+'\')" class="btn btn-danger btn-lg">Eliminar</a></td>'+
							 '</tr>'
		                     );	
				}else{
					alert('Error al recibir la respuesta del Servidor');
				}
			});
});
