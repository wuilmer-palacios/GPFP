<?php
	session_start();
	if (!isset($_SESSION["responsable"]) OR !isset($_SESSION["idResponsable"])) {
		header('location:../login.php');
	}
	
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
						<?php echo $_SESSION["responsable"];?>
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
							<?php if ($_SESSION["tipoUser"]=="1"): ?>
								<li>
									<a href="nuevoProyecto.php">Nuevo Proyecto</a>
								</li>	
							<?php endif ?>
						
							<li>
								<a href="verProyecto.php">Ver Proyectos</a>
							</li>
							<?php if ($_SESSION["tipoUser"]=="1"): ?>
								<li>
									<a href="suspenderProyecto.php">Suspender</a>
								</li>	
							<?php endif ?>
							
						</ul>
					</li>
					<?php if ($_SESSION["tipoUser"]=="1"): ?>
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
					<?php endif ?>
					
					<!-- <li>
						<a id="subMenu4" value="avances" onclick="despliegaSubMenu4();" href="#">Gestion de Avances</a>
						<ul id="children4" style="display:none;" class="children">
							<li>
								<a href="nuevoParticipante.php">Gestion de Avances</a>
							</li>
							<li>
								<a href="verParticipante.php">Ver Participante</a>
							</li>
						</ul>
					</li> -->
					<li>
						<a href="" onclick="cerrarSession2()">Cerrar Session</a>
					</li>
				</ul>
			</div>

			<!-- Cuerpo del body -->
			<div id="capa" class="">
				<div class="row">
					<div class="col-md-10 center-block">
						<ol id="participantes" style="background:red; padding: 20px; list-style:none;">
							<?php
								while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) {
									$var+=1;
									echo '
									<li id="parti['.$var.']" class="participantes" value="'.$row["idParticipante"].'" >'
										.$row["primerNombre"]." ".$row["primerApellido"].
									'</li>

									';
								}
							?>
						</ol>
					</div>
				</div>			
			</div>
		</div>
	</div>
</body>
</html>