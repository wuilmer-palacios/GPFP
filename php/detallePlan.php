<?php

	include('conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");
	$dato=base64_decode($_GET["id"]);
	$plan=base64_decode($_GET["plan"]);
	$responsable=base64_decode($_GET["responsable"]);	

	if (!isset($dato) OR !isset($plan) OR !isset($responsable)) {
		header("Location:../");
	}

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
	<script>
        // Funcion para limitar el numero de caracteres de un textarea o input
        // Tiene que recibir el evento, valor y número máximo de caracteres
        function limitar(e, contenido, caracteres)
        {
            // obtenemos la tecla pulsada
            var unicode=e.keyCode? e.keyCode : e.charCode;
 
            // Permitimos las siguientes teclas:
            // 8 backspace
            // 46 suprimir
            // 13 enter
            // 9 tabulador
            // 37 izquierda
            // 39 derecha
            // 38 subir
            // 40 bajar
            if(unicode==8 || unicode==46 || unicode==13 || unicode==9 || unicode==37 || unicode==39 || unicode==38 || unicode==40)
                return true;
 
            // Si ha superado el limite de caracteres devolvemos false
            if(contenido.length>=caracteres)
                return false;
 
            return true;
        }
    </script>
	
	
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

			<!-- Cuerpo del Body -->
			<div id="capa" class="">
				<div style="padding:10px 0px; " class="row center-block">
					<!-- <div class="col-md-12 col-devolver">
						<a href="#">
							<span class="icon-arrow-left"></span>
						</a>
					</div> -->
					<div id="col-table" style="display:none;" class="col-md-12">
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

				<div id="detalle-gestion-avance" style="display:noFne;" class="row">
					<div class="col-md-12 col-devolver">
						<a href="#" onclick="iratras();">
							<span class="icon-arrow-left"></span>
						</a>
					</div>
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
										<button class="botones-td btn">
											Sumar al Avance
										</button>
									</td>
									<td style="width:33%;">
										<button class="botones-td btn">
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
						<!-- <form id="form-gestion-alcance" style="width:70%;" class="center-block">
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
						<button class="center-block btn btn-primary" onclick="guardarSubAvance();">
							Registrar
						</button> -->
						<!-- Formulario de Participantes -->
						<form id="form-gestion-alcance" style="width:70%; display: non;" class="center-block">
							<div class="form-group col-md-12">
								<label for="">
									Participantes que pertenecen a este alcance
								</label>
								<input type="hidden" name="tipo" value="nuevoAlcance">
								<select id="participantes" multiple class="form-control" name="participantes" ondblclick="agregaParticipante();">
									<option>jhsdgjas</option>
									<option>jhsdgdjas</option>
								</select>
							</div>
							<div class="col-md-12">
								<ul id="lista-dinamica" class="list-group list-group-flush">
									
								</ul>
							</div>							
						</form>
						<br>
						<div class="col-md-12">
							<button class="center-block btn btn-primary">
								Añadir
							</button>	
						</div>
												
					</div>
			
					<div style="display:none;" class="col-md-6" style="padding-right:30px;">
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
							<div class="col-md-12 lista-subAvances">
								<h5 style="font-weight:900;" class="text-center">
										Observaciones
								</h5>
							</div>	
						</div>
					</div>

					<!-- /*sdfsdf*/ -->
					<div class="col-md-6" style="padding-right:30px;">
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
			</div>
		</div>
	</div>
</body>
</html>