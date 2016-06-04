  var rut;

  $('.userDel').click( function (){
    rut = $(this).val();
    console.log(rut);
  });

  $('#okDel').click(function(){
    $.get('delete.php?rut='+rut,
          function(dato){
              if (dato.exito){
               // si la respuesta fue exitosa entonces eliminamos la fila de la tabla
                  $('#fila_'+rut).remove();
              }else{
                 alert('Error al recibir la respuesta del Servidor');
                     
              }
       });
  });

