<?php
	session_start();
	if (!isset($_SESSION["responsable"]) OR !isset($_SESSION["idResponsable"])) {
		header('location:../login.php');
	}

	include_once('conexion.php');
	$cnx= new Conexion();
	$consulta="SELECT * FROM responsables";
	$resultado=$cnx->prepare($consulta);
	$resultado->execute();

	$consulta_responsable=$consulta." "."WHERE estadoResponsable=1";
	$resultado_responsable=$cnx->prepare($consulta_responsable);
	$resultado_responsable->execute();
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
						<h5 class="text-center">
							Gestor de Responsables
						</h5>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 center-block">
						<input id="form-search" type="text" value="" name="responsable" class="form-control" placeholder="Responsable" onkeyup="listarResponsables()">
					</div>
				</div>
				<hr style="border:solid 1px; ">
				<div class="row">
					<div class="col-md-10 center-block">
						<span style="background:#22B02D" class="btn-span">Disponibles</span>
						<span style="background:#FF4C4C" class="btn-span">Suspendidos</span>
						<span style="background:#979797" class="btn-span">Completado</span>
						<br><br>
					</div>

					<div id="list-responsable" class="col-md-10 center-block">	
						<ul class="ul-responsables">
							<?php
								while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) {
									if ($row["estadoResponsable"]==0) {
										echo'
										<li style="background:#FF4C4C" onclick="detallarResponsable('.$row["idResponsable"].')">
											<b>'.$row["primerNombre"]." ".$row["primerApellido"].'</b>
										</li>';
									}
									elseif ($row["estadoResponsable"]==2) {
										echo'
										<li style="background:#979797" onclick="detallarResponsable('.$row["idResponsable"].')">
											<b>'.$row["primerNombre"]." ".$row["primerApellido"].'</b>
										</li>';
									}else{
										echo'
										<li onclick="detallarResponsable('.$row["idResponsable"].')">
											<b>'.$row["primerNombre"]." ".$row["primerApellido"].'</b>
										</li>';
									}
								}
							?>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 center-block">
						<div id="table-responsables" class="ul-responsables">
						</div>
					</div>
				</div>
				<div id="form-emergente" class="form-emergente">
					<div class="modal-dialog">

					<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Nuevo Responsable</h4>
							</div>
							<div class="modal-body">
								<div class="row center-block">
									<div class="col-md-12">
										
										<div class="row">
											<div class="col-md-12 text-center">
												<form>
													<input id="wuil" type="hidden" name="wuil" value="">
													<select id="new-responsable" class="form-control" name="responsable">
														<?php
														while ($row_responsable=$resultado_responsable->fetch(PDO::FETCH_ASSOC)) {
															$nombre=$row_responsable["primerNombre"]." ".$row_responsable["primerApellido"];
															echo '
																<option value="'.$row_responsable["idResponsable"].'">'.$nombre.'</option>
															';
														}
														?>
													</select>
													<br>
												</form>
											</div>
											<div class="col-md-12 text-center">
												<button id="boton-anadir" class="btn btn-success" onclick="cambiarResponsable();">
													Cambiar
												</button>
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
								<button type="button" class="btn btn-default" data-dismiss="modal" onclick="formEmergenteClose()">
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