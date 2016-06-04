	var rutt;

	$('.boton').click( function (){
		rutt = $(this).val();
		console.log(rutt);
		$.get('showUser.php?rut='+rutt,
			function(response){
				//Callback que se encarga de llenar el modal con valores actuales
				if(response.exito){// exito es el primer valor del JSON y es de tipo booleano
					$("#up-rut").val(rutt);
					$("#up-nombre").val(response.nomb);
					$("#up-email").val(response.mail);
					$("#up-telefono").val(response.fono);
				}else
					alert("Error al procesar respuesta del servidor"+"\n"+response.errorr)
			})
	});

	$('#form-actualizar').submit(function(event){
		event.preventDefault();
		console.log("hola");

		$.post('update.php?rut='+rutt,
			$('#form-actualizar').serialize(),
				function(dato){
					if(dato.exito){
						var variable="";
						if(dato.cargo == 12) variable="Jefe Proyecto";
						if(dato.cargo == 23) variable="Analista";
						if(dato.cargo == 32) variable="Desarrollador";

						 $('#fila_'+rutt).remove();
						 $('#tabla-registro tr:last').after(
		                     '<tr id="fila_'+rutt+'">'+
			                     '<td>'+rutt+'</td>'+
			                     '<td>'+dato.nombre+'</td>'+
			                     '<td>'+dato.email+'</td>'+
			                     '<td>'+dato.telefono+'</td>'+
			                     '<td>'+variable+'</td>'+
								 '<td> <button value=\''+rutt+'\' type="button" class="btn btn-info btn-lg boton" data-toggle="modal" data-target="#myModal">Actualizar</button> - <a id="eliminar" onclick="eliminar( \''+rutt+'\')" class="btn btn-danger btn-lg">Eliminar</a></td>'+
							 '</tr>'
		                     );	
						 
	                     $("#myModal").modal('hide');
					}else{
						alert('Error al recibir la respuesta del Servidor');
					}
				});
	});
