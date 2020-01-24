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
	<meta charset="utf-8">
	<meta http-equiv=content-type content=text/html; charset=utf-8>
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
						<a id="subMenu4" value="avances" onclick="despliegaSubMenu4();" href="#">Gestion de Avances</a>
						<ul id="children4" style="display:none;" class="children">
							<li>
								<a href="nuevoParticipante.php">Gestion de Avances</a>
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
						<form id="form-plan-tactico"action="" method="POST">
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
									<input id="fechaInicio" class="form-control" type="date" name="fechaInicio" min="2020-01-01" onblur="validaFechaInicio();">
									<label style="display:none;" id="label-inicio" class="label-control-warning">
										<span class="icon-warning"></span>--
										<span class="icon-warning"></span>--
										<span class="icon-warning"></span>
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
					<div id="form-alcence" style="display:nosne;" class="col-md-5 center-block">
						<form id="form-alcances" method="POST" accept-charset="utf-8">
							<div class="row">
								<div class="col-md-12">
									Agregar Alcances
									<input id="idPlan" type="text" name="idPlan" value="1" readonly="readonly">
									<input id="nombreAlcance" class="form-control" type="text" name="nombreAlcance" onblur="validaNombreAlcance();">
									<label style="display:none;" id="label-control-danger-alcance" class="label-control-danger">
										Ya existe un Ancance con este nombre
									</label>

									<br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									Fecha de Inicio
									<input id="fechaInicioAlcance" class="form-control" type="date" name="fechaInicioAlcance" min="2020-01-01" max="" onblur="validaFechaInicioAlcance();">
									<br>
								</div>
								<div class="col-md-6">
									Fecha Final
									<input id="fechaFinalAlcance" class="form-control" type="date" name="fechaFinalAlcance" min="" max="" onblur="validaFechaFinalAlcance();">
									<label style="display:none;" id="label-final-alcance" class="label-control-warning">
										<span class="icon-warning"></span>
										Fecha Invalida
									</label>
									<br>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label for="">
										Participantes que pertenecen a este alcance
									</label>
									<input type="hidden" name="tipo" value="nuevoAlcance">
									<select id="participantes" multiple class="form-control" name="participantes" ondblclick="agregaParticipante();">
										<?php
											while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) {
												$var+=1;
												echo '
												<option id="parti['.$var.']" class="participantes" value="'.$row["idParticipante"].'" >'.$row["primerNombre"]." ".$row["primerApellido"].'</option>

												';
											}
										?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<ul id="lista-dinamica" class="list-group list-group-flush">

									</ul>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-md-12 text-center">
								<button id="boton-anadir" class="btn btn-success" onclick="unirAlcanceYParticipante();"> Añadir </button>
							</div>
							<hr>
							<div style="display: none;" id="success-card" class="col-md-12 text-center">
								<div class="alert alert-success alert-dismissible">
									<strong>Nuevo Alcance Registrado con exito.</strong>
								</div>
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

				<div id="form-table-wuil" style="display: none" class="row row-body">
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
								<th style="width: 20%;">
									Responsable
								</th>
								<td style="width:80%;" colspan="2">
									<label id="nameResponsable">
										
									</label>
								</td>
							</tr>
							
							<tr>
								<th colspan="3">
									Alcances
								</th>
							</tr>

							<!-- Parte Dinamica -->
							<tr id="antepenultimo-tr">
								
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>