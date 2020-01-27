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

							<li>
								<a href="suspenderProyecto.php">Suspender</a>
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
						<h5 class="text-center">Registro de Nuevo Responsable</h5>
						<br>
					</div>
				</div>
				<form id="form-responsable" class="row" method="POST">
					<div style="" class="col-md-8 center-block">
						<div class="row">
							<div class="col-md-6">
								Primer Nombre
								<input id="primerNombre" class="form-control" type="text" name="primerNombre">
								<br>
							</div>
							<div class="col-md-6">
								Segundo Nombre
								<input id="segundoNombre" class="form-control" type="text" name="segundoNombre">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Primer Apellido
								<input id="primerApellido" class="form-control" type="text" name="primerApellido">
								<br>
							</div>
							<div class="col-md-6">
								Segundo Apellido
								<input id="segundoApellido" class="form-control" type="text" name="segundoApellido">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								Area de dependencia
							</div>
							<div class="col-md-6">
								<input type="hidden" name="tipo" value="responsable">
								<select class="form-control">
									<option>--Seleccione--</option>
								</select>
								<br>
							</div>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-md-8 center-block">
						<button class="btn btn-primary" onclick="registraResponsable()">
							Registrar
						</button>
					</div>
				</div>
				<br>
				<div style="display:none;" id="lista-registro" class="row content-center">
					<div id="col-list" class="col-md-12 text-center">
						<label class="success">
							Nuevo responsable agregado con exito
						</label>
						<label id="label" class="juanca">
							asdasd
						</label>
					</div>
				</div>			
			</div>
		</div>
	</div>
</body>
</html>