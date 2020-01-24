<?php

	include('conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");

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
				
				<!-- Modal -->
				<!-- <div class="modal fade" id="myModal" role="dialog"> -->
				<div>
					<div class="modal-dialog">

					<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Nuevo Alcance</h4>
							</div>
							<div class="modal-body">
								<div class="row center-block">
									<div class="col-md-12">
										<form>
											<label>
												Nombre de la Actividad
											</label>
											<input class="form-control" type="text" name="">
											<br>
											
											<div class="row">
												<div class="col-md-6">
													<label>
														Fecha Inicio
													</label>
													<input class="form-control" type="date" name="">
												</div>
												<div class="col-md-6">
													<label>
														Fecha Final
													</label>
													<input class="form-control" type="date" name="">
												</div>
											</div>											
											<br>
											<label>
												Participantes
											</label>
											<br>
											<select multiple="" class="form-control">
												<option>Uno</option>
												<option>Otro</option>
												<option>asad</option>
											</select>
										</form>
										<br>
										<button class="btn btn-primary">
												Registrar
											</button>
										<div class="col-md-12 content-center">
											
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>