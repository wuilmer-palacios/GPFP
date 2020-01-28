<?php
	include('conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");

	$consulta_proyectos="SELECT * FROM planes_tacticos 
	INNER JOIN responsables ON planes_tacticos.responsable = responsables.idResponsable ORDER BY planes_tacticos.plan ASC";
	
	$resultado=$conexion->prepare($consulta_proyectos);
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
	<link rel="stylesheet" type="text/css" href="../css-my-style/porcentajes.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js_fun/my_functions.js" type="text/javascript"></script>
	<script src="../js_fun/functionsInserts.js" type="text/javascript"></script>
	<script src="../js_fun/busquedasDinamicas.js" type="text/javascript"></script>
</head>
<body onload="actualizar();">
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
						<input id="nombreProyecto" class="form-control" type="search" name="" placeholder="Proyecto o Responsable" onkeyup="listarProyectos2()">
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
						<table id="tabla" class="table table-bordered">
							<thead id="proyectos" class="thead-dark">
								<tr>
									<th style="width:8%;">Estado</th>
									<th style="width:18%;">Nombre del Proyecto</th>
									<th style="width:18%;">Responsable</th>
									<th style="width:9%;">Fecha Inicio</th>
									<th style="width:9%;">Fecha Final</th>
									<th style="width:24%;">Nivel de Avance</th>
									<th style="width:14%;">Controles</th>
								</tr>
							</thead>
							<?php
								while ($row_pla=$resultado->fetch(PDO::FETCH_ASSOC)) {
									$rsp=$row_pla["primerNombre"].' '.$row_pla["primerApellido"];
									switch ($row_pla["estadoPlan"]) {
										case '0':
											$estadoPlan="<b>Sin Iniciar</b>";
											break;
										case '1':
											$estadoPlan="<b>En Ejecucion</b>";
											break;
										case '2':
											$estadoPlan="<b>Terminado</b>";
											break;
										case '3':
											$estadoPlan="<b style='color:#E57F05'>Pausado</b>";
											break;
										case '4':
											$estadoPlan="<b style='color:red'>Cancelado</b>";
											break;
										
									}
									if ($row_pla["estadoPlan"]=="3" OR $row_pla["estadoPlan"]=="4"){
										echo '
											<tr>
												<td>
													'.$estadoPlan.'
													<input type="hidden">
												</td>
												<td>
													'.$row_pla["plan"].'
												</td>
												<td>
													'.$rsp.'
												</td>
												<td>
													'.$row_pla["fechaInicio"].'
												</td>
												<td>
													'.$row_pla["fechaFinal"].'
												</td>
												<td>
													<div class="progress-wuil">
														<div class="progress-bar-wuil procentaje-'.$row_pla["avance"].'" style="width: '.$row_pla["avance"].'%;">
															'.$row_pla["avance"].'%
														</div>
													</div>
												</td>
												<td class="align-middle text-center">
													<button style="border:none" onclick="stop('.$row_pla["idPlan"].')">
														<span class="icon-stop2 btn btn-danger"></span>
													</button>
													<button style="border:none" onclick="pause('.$row_pla["idPlan"].')">
														<span class="icon-pause2 btn btn-warning"></span>
													</button>
													<button style="border:none" onclick="play('.$row_pla["idPlan"].')">
														<span class="icon-play3 btn btn-success"></span>
													</button>
												</td>
												
											</tr>
										';
									}
									else{
										echo '
											<tr>
												<td>
													'.$estadoPlan.'
												</td>
												<td>
													'.$row_pla["plan"].'
												</td>
												<td>
													'.$rsp.'
												</td>
												<td>
													'.$row_pla["fechaInicio"].'
												</td>
												<td>
													'.$row_pla["fechaFinal"].'
												</td>
												<td>
													<div class="progress-wuil">
														<div class="progress-bar-wuil procentaje-'.$row_pla["avance"].'" style="width: '.$row_pla["avance"].'%;">
															'.$row_pla["avance"].'%
														</div>
													</div>
												</td>
												<td class="align-middle text-center">
													<button style="border:none" onclick="stop('.$row_pla["idPlan"].')">
														<span class="icon-stop2 btn btn-danger"></span>
													</button>
													<button style="border:none" onclick="pause('.$row_pla["idPlan"].')">
														<span class="icon-pause2 btn btn-warning"></span>
													</button>
													<button style="border:none" onclick="play('.$row_pla["idPlan"].')">
														<span class="icon-play3 btn btn-success"></span>
													</button>
												</td>
												
											</tr>
										';
									}	
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>