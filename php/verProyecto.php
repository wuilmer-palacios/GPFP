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
						<h5 class="text-center">Ver proyectos "En construccion"</h5>
						<br>
					</div>
				</div>			
			</div>
		</div>
	</div>
</body>
</html>