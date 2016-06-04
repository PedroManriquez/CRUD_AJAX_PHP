<?php
	require('connection.php');
	$db= new ConnectionDB();

	$rut = $db->escape_string($_POST['rut']);
    $nombre = $db->escape_string($_POST['nombre']);
    $mail = $db->escape_string($_POST['email']);
    $telefono = $db->escape_string($_POST['telefono']);
    $cargo = $db->escape_string($_POST['cargo']);

    /* Enviamos la instrucción SQL que permite ingresar 
    los datos a la BD en la tabla contactos */
    if($db->query("insert into contacto values ('$rut','$nombre','$mail','$telefono', '$cargo');")){
    	header('Content-Type: application/json');
    	echo json_encode(array('exito'=>true, 'rut'=>$rut,'nombre'=>$nombre, 'email'=>$mail,'telefono'=>$telefono,'cargo'=>$cargo));
    }else{
    	die("Ocurrio UN problema al ejecutar la consulta de insercion en BBDD error [ ".$db->error." ]");
    }

?>