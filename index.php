<?php
	require('connection.php');
	$db= new ConnectionDB();
	$select=$db->query("select * from cargo;");
	$filas=$db->rows($select);
	$tabla=$db->query('select * from contacto');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CrudPHPconAJAX</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body id="body">
	<br>
	<h2>CRUD en AJAX con PHP</h2>
	<br>
	<div class="container">
		<div class="jumbotron">
			<form id="form-ingreso" class="form" >
				<div class="row form-group">
					<div class="col-md-3">
						<label for="rut">RUT :</label>
					</div>
					<div class="col-md-5">
						<input name="rut" class ="form-control"type="text" placeholder="Aquí el Rut">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<label for="nombre">Nombre : </label>
					</div>
					<div class="col-md-5">
						<input name="nombre" class ="form-control"type="text" placeholder="Aquí el Nombre">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<label for="email">Correo Electrónico :</label>
					</div>
					<div class="col-md-5">
						<input name="email" class ="form-control"type="text" placeholder="Aquí el E-Mail">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<label for="fono">Telefono :</label>
					</div>
					<div class="col-md-5">
						<input name="telefono" class ="form-control"type="text" placeholder="Aquí el Telefono">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<label for="cargo">Cargo Institucional :</label>
					</div>
					<div class="col-md-5">
						<select name="cargo" id="" class="btn btn-default dropdown dropdown-toggle" >
							<?php if($filas>0){
								for($i=0 ; $i< $filas ; $i++){ 
									$datos= $db->recorrer($select); 
									?>
									<option value=<?php echo $datos['codigo'] ?> > <?php echo $datos['descripcion'] ?></option>
									<?php 	} 
								} 
								?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><input type="submit" class="btn btn-success btn-lg"></div>
					</div>
				</form>
			</div>
		</div>
		<div class="container">
			<div class="jumbotron">
				<h3>  Registros en tiempo real ...</h3> <br>
				<table class="table table-bordered table-hover" id="tabla-registro">
					<!-- Cabeza tabla -->
					<thead>
						<tr class="info">
							<th>Rut</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Teléfono</th>
							<th>Cargo</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<!-- Cuerpo tabla -->
					<tbody>
						<?php 
	                        // Instrucción SQL que permite rescatar todos los datos de la tabla contactos
						$sql = $db->query("select * from contacto c inner join cargo a on (c.cod_cargo=a.codigo);");
	                        // Obtenemos el número de filas del conjunto seleccionado
						$nfilas = $db->rows($sql);
	                        // Si la cantidad de filas es mayor a cero podemos proceder
						if ($nfilas > 0){
							for ($i=0; $i<$nfilas; $i++) {
	                                // Obtenemos fila en formato arreglo
								$dato = $db->recorrer($sql);
								$var=$dato['rut'];
	                                //Imprimimos los datos obtenidos    
								echo '<tr id="fila_'.$dato['rut'].'">';
								echo '<td>'. $dato['rut'] . '</td>';
								echo '<td>'. $dato['nombre'] . '</td>';
								echo '<td>'. $dato['email'] . '</td>';
								echo '<td>'. $dato['telefono'] . '</td>';
								echo '<td>'. $dato['descripcion'] . '</td>';
								echo '<td> <button value=\''.$dato['rut'].'\' type="button" class="btn btn-info btn-lg boton" data-toggle="modal" data-target="#myModal">Actualizar</button> - <button value=\''.$dato['rut'].'\' type="button" class="btn btn-danger btn-lg userDel" data-toggle="modal" data-target="#eliminarUser">Eliminar</button></td>';
								echo '</tr>';
							}
						}
						?>
					</tbody>
				</table>
				<!-- Modal para preguntar si desea borrar usuario-->
				<div class="modal fade" id="eliminarUser" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content" id="modalDel">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title etiqueta">¿Eliminar el Usuario?</h4>
							</div>
							<div class="modal-footer">
								<div class="col-md-5"><button type="button" id="okDel" class="btn btn-danger btn-lg" data-dismiss="modal">Eliminar Contacto</button></div>
								<div class="col-md-5"><button type="button" class="btn btn-success btn-lg" data-dismiss="modal">Cerrar</button></div>								
							</div>
						</div>
					</div>
				</div>
				<!-- Modal para actualizar usuario -->
				<div class="modal fade myModal" id="myModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content" id="actualizar">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title etiqueta">Actualizar Contacto</h4>
							</div>
							<div class="modal-body">
							<!-- Formulario que utilizaremos para actualizar contacto, llenaremos campos a traves de consulta ajax -->
								<form id="form-actualizar" class="form" >
									<div class="row form-group">
										<div class="col-md-5">
											<label class="etiqueta"for="rut">RUT :</label>
										</div>
										<div class="col-md-5">
											<input id="up-rut" name="up-rut" class ="form-control"type="text" placeholder="Aquí el Rut" disabled>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-5">
											<label class="etiqueta"for="nombre">Nombre : </label>
										</div>
										<div class="col-md-5">
											<input id="up-nombre" name="up-nombre" class ="form-control"type="text" placeholder="Aquí el Nombre">
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-5">
											<label class="etiqueta"for="email">Correo Electrónico :</label>
										</div>
										<div class="col-md-5">
											<input id="up-email" name="up-email" class ="form-control"type="text" placeholder="Aquí el E-Mail">
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-5">
											<label class="etiqueta"for="fono">Telefono :</label>
										</div>
										<div class="col-md-5">
											<input id="up-telefono" name="up-telefono" class ="form-control"type="text" placeholder="Aquí el Telefono">
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-5">
											<label class="etiqueta"for="cargo">Cargo Institucional :</label>
										</div>
										<div class="col-md-5">
											<select name="up-cargo" id="" class="btn btn-default dropdown dropdown-toggle" >
												<option value="12">Jefe Proyecto</option>
												<option value="23">Analista</option>
												<option value="32">Desarrollador</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-5"></div>
										<div class="col-md-5"><input type="submit" class="btn btn-success btn-lg" value="Actualizar Contacto" ></div>
									</div>
								</form>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="guardar.js"></script>
		<script type="text/javascript" src="borrar.js"></script>
		<script type="text/javascript" src="actualizar.js"></script>
	</body>
	</html>
