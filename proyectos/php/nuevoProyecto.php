<?php
	
	include_once('conexion.php');
	$cnx= new Conexion();
	$consulta="SELECT * FROM participantes WHERE estadoParticipante=1";
	$resultado=$cnx->prepare($consulta);
	$resultado->execute();

	/*Consulta para llenar select de responsables*/
	$consultaResponsables="SELECT * FROM responsables WHERE estadoResponsable=1";
	$resultadoResponsable=$cnx->prepare($consultaResponsables);
	$resultadoResponsable->execute();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Proyecto</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="../img/icon.png">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../css-my-style/style.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js_fun/my_functions.js" type="text/javascript"></script>
	<script src="../js_fun/functionsInserts.js" type="text/javascript"></script>
	
</head>
<body>
	<div id="body-z">
		<div class="container-fluid">
			<div class="row row-header">
				<header class="col-md-3 col-xs-12">
					<h5>Bienvenido al Gestor de Proyectos</h5>
				</header>
				<div class="toggle-btn col-md-1 col-xs-2">
					<span onclick="menu()">&#9776</span>
				</div>
				<div class="col-md-7 ayuda col-xs-5">
					<h6>
						User Name
					</h6>
				</div>
				<div style="text-align:left;" class="col-md-1 ayuda col-xs-5">
					<img style="width:35px; border-radius:50%" src="../img/user.jpg">
				</div>
			</div>

			<div id="sidebar" class="nav">
				
				<ul class="father">
					<li>
						<img src="../img/logo_login.png"></li>
					<li>
						<a href="../" >Inicio</a>
					</li>
					<li>
						<a id="subMenu1" onclick="despliegaSubMenu1();" href="#">Proyectos</a>
						<ul id="children1" class="children">
							<li>
								<a href="nuevoProyecto.php">Nuevo Proyecto</a>
							</li>
						
							<li>
								<a href="verProyecto.php">Ver Proyectos</a>
							</li>
						</ul>
					</li>
					<li>
						<a id="subMenu2" value="responsables" onclick="despliegaSubMenu2();" href="#">Responsables</a>
						<ul id="children2" style="display:none;" class="children">
							<li>
								<a href="nuevoResponsable.php">Nuevo Responsables</a>
							</li>
							<li>
								<a href="verResponsable.php">Ver Responsables</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a id="subMenu3" value="participantes" onclick="despliegaSubMenu3();" href="#">Participantes</a>
						<ul id="children3" style="display:none;" class="children">
							<li>
								<a href="nuevoParticipante.php">Nuevo Participante</a>
							</li>
							<li>
								<a href="verParticipante.php">Ver Participante</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Cerrar Session</a>
					</li>
				</ul>
			</div>
			<!-- Cuerpo del body -->
			<div id="capa" class="">
				<div class="row">
					<div class="col-md-10 center-block">
						<h5 class="text-center">Nuevo Plan Tactico</h5>
					</div>
				</div>
				<div class="row row-body">
					<div style="" class="col-md-5 center-block">

						<!-- Formulario del Primer Bloque donde se capturan los datos para la tabla de planes Tacticos -->
						<!-- Incio -- Inicio --  Incio -- Inicio --  Incio -- Inicio --  Incio -- Inicio --  Incio -- -->
						<form id="form-plan-tactico" action="" method="POST">
							<div class="row">
								<div class="col-md-12">
									Nombre del Plan
									<input id="nombrePlan" class="form-control" type="text" name="nombrePlan" onblur="validaNombrePlan()">
									<label style="display:none;" id="label-control-danger" class="label-control-danger">
										Ya existe un Plan con este nombre
									</label>
									<br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									Fecha de Inicio
									<input id="fechaInicio" class="form-control" type="date" name="fechaInicio" onblur="validaFechaInicio();">
									<label style="display:none;" id="label-inicio" class="label-control-warning">
										<span class="icon-warning"></span>
										La Fecha de Inicio no puede ser menor a la fecha Actual.
									</label>
									<br>
								</div>
								<div class="col-md-6">
									Fecha Final
									<input id="fechaFinal" class="form-control" type="date" name="fechaFinal" onblur="validaFechaFinal();">
									<label style="display:none;" id="label-final" class="label-control-warning">
										<span class="icon-warning"></span>
										Fecha Invalida
									</label>
									<br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									Responsable
								</div>
								<div class="col-md-12">
									<input type="hidden" name="tipo" value="nuevoPlanTactico">
									<select class="form-control" name="responsable" id="responsable" onchange="desactivarDanger();">
										<option value="nulo">--Seleccione--</option>
										<?php
										while ($row_res=$resultadoResponsable->fetch(PDO::FETCH_ASSOC)) {
										 	echo '<option value="'.$row_res["idResponsable"].'">'.$row_res["primerNombre"]." ".$row_res["primerApellido"].'</option>';
										 } 
										
										 ?>
									</select>
									<br>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-12 text-center">
								<input id="boton-registrar" type="submit" class="btn btn-primary" value="Registrar" name="" onclick="registraPlanTactico();">
							</div>
						</div>

						<!-- Fin -- Fin -- Fin -- Fin -- Fin -- Fin -- Fin -- Fin -- Fin -- Fin -- Fin -- Fin -- Fin  -->
						<!-- Formulario del Primer Bloque donde se capturan los datos para la tabla de planes Tacticos -->
						
					</div>
					<!-- sdlkjfhskj -->
					<div style="" class="col-md-5 center-block">
						<div class="row">
							<div class="col-md-12">
								Agregar Alcances
								<input class="form-control" type="text" name="" disabled="">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Fecha de Inicio
								<input class="form-control" type="date" name="" disabled="">
								<br>
							</div>
							<div class="col-md-6">
								Fecha Final
								<input class="form-control" type="date" name="" disabled="">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="">
									Participantes que pertenecen a este alcance
								</label>
								<select multiple class="form-control" id="" disabled="">
									<?php
										while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) {
											echo '
											<option class="participantes" value="'.$row["idParticipante"].'">'.$row["primerNombre"]." ".$row["primerApellido"].'</option>
											';
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-success"> Añadir </button>
							</div>
						</div>
					</div>
				</div>

				<div id="success" style="display:none;" class="row row-body">
					<div class="col-md-12 text-center">
						<label class="success">
							Nuevo Plan Registrado con Exito
						</label>
					</div>
				</div>

				<div class="row row-body">
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th colspan="3" class="text-center">Detalles del Plan Tactico</th>
								</tr>
							</thead>
							<tr>
								<th style="width: 20%;">
									Nombre del Plan Tactico
								</th>
								<td style="width:80%;" colspan="2">
									<label id="namePlanTactico">
										
									</label>
								</td>
							</tr>
							<tr>
								<th colspan="3">
									Alcances
								</th>
							</tr>

							<tr>
								<td class="align-middle" rowspan="<?php echo"5" ?>">
									Diseñar Base de Datos
								</td>
								<td class="align-middle" rowspan="5">
									<label id="fecInicio">

									</label>
									<br>
									<label id="fecFinal">
										
									</label>
								</td>
							</tr>
							<tr>
								<td>
									Wuilmer Palacios
								</td>
							</tr>
							<tr>
								<td>
									Wilson Palacios
								</td>
							</tr>
							<tr>
								<td>
									Carlos Hernandez
								</td>
							</tr>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>