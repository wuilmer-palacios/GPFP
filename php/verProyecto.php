<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Proyecto</title>
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
						<h5 class="text-center">Buscador de Proyectos</h5>
						<br>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3 center-block">
						<input id="nombreProyecto" class="form-control" type="search" name="" placeholder="Nombre:" onkeyup="listarProyectos()">
					</div>
				</div>

				<div class="row">
					<div class="col-md-5 center-block">
						<label id="listar">
							
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead class="thead-dark">
								<tr>
									<th style="width:30%;">Nombre del Proyecto</th>
									<th style="width:30%;">Responsable</th>
									<th style="width:35%;">Nivel de Avance</th>
									<th style="width:50%;">Detallar</th>
								</tr>
							</thead>
							<tr>
								<td class="align-middle">Gestor de Proyectos</td>
								<td class="align-middle">Wuilmer Palacios</td>
								<td>
									<div class="progress-wuil">
										<div class="progress-bar-wuil procentaje-35" style="width: 35%;">
											35%
										</div>
									</div>									
								</td>
								<td class="align-middle text-center">
									<a href="">
										<span class="icon-eye"></span>
									</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									Proyecto 1
								</td>
								<td class="align-middle">
									Wilson Oliveros
								</td>
								<td>
									<div class="progress-wuil">
										<div class="progress-bar-wuil procentaje-65" style="width: 65%;">
											65%
										</div>
									</div>									
								</td>
								<td class="align-middle text-center">
									<a href="">
										<span class="icon-eye"></span>
									</a>
								</td>
							</tr>
							<tr>
								<td class="align-middle">
									Proyecto 2
								</td>
								<td class="align-middle">
									Omar Hernandez
								</td>
								<td>
									<div class="progress-wuil">
										<div class="progress-bar-wuil procentaje-5" style="width: 5%;">
											5%
										</div>
									</div>									
								</td>
								<td class="align-middle text-center">
									<a href="">
										<span class="icon-eye"></span>
									</a>
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