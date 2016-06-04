

<?php
	require('connection.php');
	$db= new ConnectionDB();
	$var=$_GET['rut'];
	#$consulta="select nombre, email, telefono from contacto where rut = '$var';";	
	if($db->query("select nombre, email, telefono from contacto where rut like '$var';")){
		$dato= $db->recorrer($db->query("select nombre, email, telefono from contacto where rut like '$var';"));
		$name=$dato['nombre'];
		$mail=$dato['email'];
		$fono=$dato['telefono'];
    	header('Content-Type: application/json');
    	echo json_encode(array('exito'=>true, 'nomb'=>$name , 'mail'=>$mail,'fono'=>$fono));
    }else{
    	header('Content-Type: application/json');
    	echo json_encode(array('exito'=>false, 'errorr'=>$db->error));   }
?>