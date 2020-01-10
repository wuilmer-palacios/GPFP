<?php
	include_once('conexion.php');

	$cnx= new Conexion();
		$cod=null;
		$primerNombre=$_POST["primerNombre"];
		$segundoNombre=$_POST["segundoNombre"];
		$primerApellido=$_POST["primerApellido"];
		$segundoApellido=$_POST["segundoApellido"];
		$estado=1;
		
		$consulta="INSERT INTO participantes (idParticipante, primerNombre, segundoNombre, primerApellido, segundoApellido, estadoParticipante) VALUES ('$cod','$primerNombre', '$segundoNombre', '$primerApellido', '$segundoApellido', '$estado')";
		;
		$resultado=$cnx->prepare($consulta);
		if ($resultado->execute()) {
			echo "Registro exitos";
		}
		else{
			
		}
	
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
						<h5 class="text-center">Registro de Nuevo participante</h5>
						<br>
					</div>
				</div>
				<form class="row" action="<?php echo$_SERVER["PHP_SELF"] ?>" method="POST">
					<div style="" class="col-md-8 center-block">
						<div class="row">
							<div class="col-md-6">
								Primer Nombre
								<input class="form-control" type="text" name="primerNombre">
								<br>
							</div>
							<div class="col-md-6">
								Segundo Nombre
								<input class="form-control" type="text" name="segundoNombre">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								Primer Apellido
								<input class="form-control" type="text" name="primerApellido">
								<br>
							</div>
							<div class="col-md-6">
								Segundo Apellido
								<input class="form-control" type="text" name="segundoApellido">
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								Area de dependencia
							</div>
							<div class="col-md-6">
								<select class="form-control">
									<option>--Seleccione--</option>
								</select>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<button type="submit" name="enviar" class="btn btn-primary">
									Registrar
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

</head>
<body>

</body>
</html>