<?php

	include('conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");
	$dato=base64_decode($_GET["id"]);
	$plan=base64_decode($_GET["plan"]);
	$fInicioPlan=base64_decode($_GET["fechaInicio"]);
	$fFinalPlan=base64_decode($_GET["fechaFinal"]);
	$responsable=base64_decode($_GET["responsable"]);
	$fInicioPlan=substr($fInicioPlan, 0, 10);
	$fFinalPlan=substr($fFinalPlan, 0, 10);	
	if (!isset($dato) OR !isset($plan) OR !isset($responsable)) {
		header("Location:../");
	}
	$consulta_partcipantes="SELECT * FROM participantes WHERE estadoParticipante=1";
	$resultado=$conexion->prepare($consulta_partcipantes);
	$resultado->execute();

	$resultado2=$conexion->prepare($consulta_partcipantes);
	$resultado2->execute();

?>
<!DOCTYPE html>
<html>
<head>
	<title> Gestor de Proyectos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="../img/icon.png">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../css-my-style/style.css">
	<link rel="stylesheet" type="text/css" href="../css-my-style/porcentajes.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js_fun/my_functions.js" type="text/javascript"></script>
	<script src="../js_fun/functionsInserts.js" type="text/javascript"></script>
	<script src="../js_fun/busquedasDinamicas.js" type="text/javascript"></script>
</head>
<body onload="dibujar()">
	<div id="body-z">
		<div class="container-fluid">
			<div class="row row-header" style="z-index:1000">
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
						<ul id="children2" style="display:block;" class="children">
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
						<ul id="children3" style="display:block;" class="children">
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
						<ul id="children4" style="display:block;" class="children">
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

			<!-- Cuerpo del Body -->
			<div id="capa" class="">
				<div style="padding:10px 0px; " class="row center-block">
					<div id="iratras2" style="display:block;" class="col-md-12 col-devolver">
						<a href="verProyecto.php" onclick="iratras2();">
							<span class="icon-arrow-left"></span>
						</a>
					</div>
					<div id="iratras" style="display:none;" class="col-md-12 col-devolver">
						<a href="#" onclick="iratras();">
							<span class="icon-arrow-left"></span>
						</a>
					</div>

					<div id="col-table" style="display:non; z-index:500" class="col-md-12">
						<form id="datos" action="" method="POST">
							<input id="idPlan" type="hidden" name="idPlan" value="<?php echo $dato ?>">
							<input id="namePlan" type="hidden" name="namePlan" value="<?php echo $plan ?>">
							<input id="responsable" type="hidden" name="responsable" value="<?php echo $responsable ?>">
						</form>
						
						<table id="tabla" class="table">
							<thead class="thead-dark">
								<tr>
									<th colspan="3">
										Detalles del Plan
									</th>
								</tr>
								<tr>
									<td>
										Nombre Plan
									</td>
									<td>
										<?php
											echo $plan;
										?>
									</td>
								</tr>
								<tr>
									<td>
										Responsable
									</td>
									<td>
										<?php
											echo $responsable;
										?>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										Alcances:
									</td>
								</tr>
								<!-- PARTE DINAMICA -->
								<tr>
									<td rowspan="4">
										Levantamiento de Informacion
									</td>
									<td rowspan="4">
										fechas
									</td>
								</tr>
								<tr>
									<td>sdaadsd</td>
								</tr>
								<tr>
									<td>sdaadsd</td>
								</tr>
								<tr>
									<td>sdaadsd</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>

				<div id="detalle-gestion-avance" style="display:none;" class="row">
					<div class="col-md-6 ">
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th colspan="3">
										Gestion de Avances
									</th>
								</tr>
								<tr class="no-linea">
									<td colspan="3">
										
									</td>
								</tr>
								<tr class="no-linea">
									<td style="width:33%;">
										<button class="botones-td btn" onclick="sumarAvance();">
											Sumar al Avance
										</button>
									</td>
									<td style="width:33%;">
										<button class="botones-td btn" onclick="buttonParticipantes();">
											Participantes
										</button>
									</td>
									<td style="width:33%;">
										<button class="botones-td btn">
											Recursos
										</button>
									</td>
								</tr>
							</thead>
						</table>
						<form id="form-gestion-alcance" style="width:70%; display: none;" class="center-block">
							<label>
								Nombre Alcance
							</label>
							<input id="idAlcance" class="form-control" type="hidden" name="idAlcance" value="" readonly="readonly">
							<input id="nameAlcance" class="form-control" type="text" value="" readonly="readonly">
							<br>
							<label>
								Tarea Realizada
							</label>
							<input id="tarea" class="form-control" type="text" name="tarea">
							<br>
							<label>
								Observaciones
							</label>
							<textarea id="observacion" class="form-control" rows="2" placeholder="Observaciones" name="observacion"></textarea>
							<br>
							<label>
								Valor de la Tarea  %
							</label>
							<select id="valorPorcentaje" class="form-control" name="valorPorcentaje">
								<option value="nulo">--Seleccione--</option>
								<?php
									for ($i=1; $i <= 100; $i++) { 
										echo'
											<option value="'.$i.'">'.$i.' %</option>
										';
									};
								?>
							</select>
							
						</form>
						<br>
						<button id="boton-tareas" style="display:none;" class="center-block btn btn-primary" onclick="guardarSubAvance();">
							Registrar
						</button>
						<!-- Formulario de Participantes -->
						<form id="form-gestion-participantes" style="display:none;" style="width:70%; display:block;" class="center-block">
							<div class="form-group col-md-12">
								<label for="">
									Participantes agregar
								</label>
								<input type="hidden" name="tipo" value="nuevoAlcance">
								<select id="participantes" multiple class="form-control" name="participantes" ondblclick="agregaParticipante2();">
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
							<div class="col-md-12">
								<ul id="lista-dinamica" class="list-group list-group-flush">
									
								</ul>
							</div>							
						</form>
						<br>
						<div class="col-md-12">
							<button id="button-participantes" style="display:none;" class="center-block btn btn-primary" onclick="agregarParticipante();">
								Añadir
							</button>	
						</div>
												
					</div>
			
					<div id="historial-avances" style="display:none;" class="col-md-6" style="padding-right:30px;">
						<div class="row">
							<div class="col-md-12 lista-subAvances">
								<h5 style="font-weight:900;" class="text-center">
										Historial de Avances
								</h5>
								<ol id="lista-historial" style="padding-left:15px;" class="lista-historial">
									
								</ol>
							</div>
							<div class="col-md-12">
								<br>
							</div>
							<!-- <div class="col-md-12 lista-subAvances">
								<h5 style="font-weight:900;" class="text-center">
										Observaciones
								</h5>
							</div> -->
						</div>
					</div>

					<!-- /*sdfsdf*/ -->
					<div id="historial-participantes" style="display:none;" class="col-md-6" style="padding-right:30px;">
						<div class="row">
							<div class="col-md-12 lista-subAvances">
								<h5 style="font-weight:900;" class="text-center">
										Participantes de Este Avance
								</h5>
								<ol id="lista-particpantes" style="padding-left:15px;" class="lista-historial">
									
								</ol>
							</div>
							<div class="col-md-12">
								<br>
							</div>	
						</div>
					</div>
				</div>

				<div id="form-emergente" class="form-emergente">
					<div class="modal-dialog">

					<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Nuevo Alcance</h4>
							</div>
							<div class="modal-body">
								<div class="row center-block">
									<div class="col-md-12">
										<form id="form-alcances" method="POST" accept-charset="utf-8">
											<div class="row">
												<div class="col-md-12">
													Agregar Alcances
													<input id="idPlan" type="hidden" name="idPlan" value="<?php echo$dato ?>" readonly="readonly">
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
													<input id="fechaInicioAlcance" class="form-control" type="date" name="fechaInicioAlcance" min="<?php echo $fInicioPlan ?>" max="<?php echo $fFinalPlan ?>" onblur="validaFechaInicioAlcance();">
													<br>
												</div>
												<div class="col-md-6">
													Fecha Final
													<input id="fechaFinalAlcance" class="form-control" type="date" name="fechaFinalAlcance" min="<?php echo $fInicioPlan ?>" max="<?php echo $fFinalPlan ?>" onblur="validaFechaFinalAlcance();">
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
													<select id="participantes3" multiple class="form-control" name="participantes" ondblclick="agregaParticipante3();">
														<?php
															while ($row=$resultado2->fetch(PDO::FETCH_ASSOC)) {
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
													<ul id="lista-dinamica3" class="list-group list-group-flush">

													</ul>
												</div>
											</div>
										</form>
										<div class="row">
											<div class="col-md-12 text-center">
												<button id="boton-anadir" class="btn btn-success" onclick="unirAlcanceYParticipante2();"> Añadir </button>
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
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" onclick="formEmergenteClose();">
									Close
								</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>