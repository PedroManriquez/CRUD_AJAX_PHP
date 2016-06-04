<?php
	require('connection.php');
	$db= new ConnectionDB();

	$var=$db->escape_string($_GET['rut']);
    /* Enviamos la instrucción SQL que permite ingresar 
    los datos a la BD en la tabla contactos */
    if($db->query("delete from contacto where rut = '".$var."';")){
    	header('Content-Type: application/json');
    	echo json_encode(array('exito'=>true, 'rut'=>$var));
    }else{
    	die("Ocurrio un problema al ejecutar la consulta de insercion en BBDD error [ ".$db->error." ]");
    }

?>


