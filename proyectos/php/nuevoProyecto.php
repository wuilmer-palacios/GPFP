<?php
	
	include_once('conexion.php');
	$cnx= new Conexion();
	$consulta="SELECT * FROM participantes WHERE estadoParticipante=1";
	$resultado=$cnx->prepare($consulta);
	$resultado->execute();

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
						<a href="#" >Inicio</a>
					</li>
					<li>
						<a id="subMenu1" onclick="despliegaSubMenu1();" href="#">Proyectos</a>
						<ul id="children1" class="children">
							<li>
								<a href="php/nuevoProyecto.php">Nuevo Proyecto</a>
							</li>
						
							<li>
								<a href="php/verProyecto.php">Ver Proyectos</a>
							</li>
						</ul>
					</li>
					<li>
						<a id="subMenu2" value="responsables" onclick="despliegaSubMenu2();" href="#">Responsables</a>
						<ul id="children2" style="display:none;" class="children">
							<li>
								<a href="">Nuevo Responsables</a>
							</li>
							<li>
								<a href="php/nuevoProyecto">Ver Responsables</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a id="subMenu3" value="participantes" onclick="despliegaSubMenu3();" href="#">Participantes</a>
						<ul id="children3" style="display:none;" class="children">
							<li>
								<a href="">Nuevo Participante</a>
							</li>
							<li>
								<a href="php/nuevoProyecto">Ver Participante</a>
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
				<form class="row">
					<div style="" class="col-md-5 center-block">
						<div class="row">
							<div class="col-md-12">
								Nombre del Plan
								<input class="form-control form-control-danger" type="text" name="">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Fecha de Inicio
								<input class="form-control" type="date" name="">
								<br>
							</div>
							<div class="col-md-6">
								Fecha Final
								<input class="form-control" type="date" name="">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								Responsable
							</div>
							<div class="col-md-12">
								<select class="form-control" name="responsable">
									<option value="">--Seleccione--</option>
									<option value="Juan Carrizo">Juan Carrizo</option>
									<option value="Wuilmer Andres">Wuilmer Andres</option>
									<option value="Wilson Eduardo">Wilson Eduardo</option>
								</select>
								<br>
							</div>
						</div>
					</div>
					<!-- sdlkjfhskj -->
					<div style="" class="col-md-5 center-block">
						<div class="row">
							<div class="col-md-12">
								Agregar Alcances
								<input class="form-control" type="text" name="">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Fecha de Inicio
								<input class="form-control" type="date" name="">
								<br>
							</div>
							<div class="col-md-6">
								Fecha Final
								<input class="form-control" type="date" name="">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="">
									Participantes que pertenecen a este alcance
								</label>
								<select multiple class="form-control" id="">
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
							<div class="col-md-6">
								<button class="btn btn-success"> + </button>
							</div>
						</div>
					</div>
				</form>
				<br>
				<br>
				<br>
				<div class="row">
					<div class="col-md-11 center-block">
						Proyecto Fulano de tal
					</div>
					<hr style="background: red">
					<div class="col-md-11 center-block">
						<table>
							<thead>
								<tr>
									<th>Actividad N° 1</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>