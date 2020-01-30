<?php

	include('../conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");

	if (isset($_POST["sendProyectoOrResponsable"])) {

		$nombreProyecto=$_POST["sendProyectoOrResponsable"];

		if ($nombreProyecto=="") {

			$consulta_proyectos="SELECT * FROM planes_tacticos
			INNER JOIN responsables ON planes_tacticos.responsable = responsables.idResponsable ORDER BY planes_tacticos.plan ASC";
			$resultado=$conexion->prepare($consulta_proyectos);
			$resultado->execute();

			echo '
					<table class="table table-bordered">
						<thead id="proyectos" class="thead-dark">
							<tr>
								<th style="width:5%;">Estado</th>
								<th style="width:20%;">Nombre del Proyecto</th>
								<th style="width:20%;">Responsable</th>
								<th style="width:10%;">Fecha Inicio</th>
								<th style="width:10%;">Fecha Final</th>
								<th style="width:30%;">Nivel de Avance</th>
								<th style="width:5%;">Detallar</th>
							</tr>
						</thead>
				';
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
								<span class="icon-eye-blocked"></span>
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
								<a href="detallePlan.php?id='.base64_encode($row_pla["idPlan"]).'&plan='.base64_encode($row_pla["plan"]).'&fechaInicio='.base64_encode($row_pla["fechaInicio"]).'&fechaFinal='.base64_encode($row_pla["fechaFinal"]).'&responsable='.base64_encode($rsp).'">
									<span class="icon-eye"></span>
								</a>
							</td>
							
						</tr>
					';
				}
				
			}
			echo "</table>";
		}
		else {
			$consulta_proyectos="SELECT * FROM planes_tacticos
			INNER JOIN responsables ON planes_tacticos.responsable = responsables.idResponsable
			WHERE planes_tacticos.plan LIKE '%$nombreProyecto%' OR responsables.primerNombre LIKE '%$nombreProyecto%' OR responsables.primerApellido LIKE '%$nombreProyecto%'";
			$resultado=$conexion->prepare($consulta_proyectos);
			$resultado->execute();
			$numColum=0;

			echo '
					<table class="table table-bordered">
						<thead id="proyectos" class="thead-dark">
							<tr>
								<th style="width:5%;">Estado</th>
								<th style="width:20%;">Nombre del Proyecto</th>
								<th style="width:20%;">Responsable</th>
								<th style="width:10%;">Fecha Inicio</th>
								<th style="width:10%;">Fecha Final</th>
								<th style="width:30%;">Nivel de Avance</th>
								<th style="width:5%;">Detallar</th>
							</tr>
						</thead>
				';
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
				if ($row_pla["estadoPlan"]=="3" OR $row_pla["estadoPlan"]=="4") {
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
							<span class="icon-eye-blocked"></span>
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
								<a href="detallePlan.php?id='.base64_encode($row_pla["idPlan"]).'&plan='.base64_encode($row_pla["plan"]).'&fechaInicio='.base64_encode($row_pla["fechaInicio"]).'&fechaFinal='.base64_encode($row_pla["fechaFinal"]).'&responsable='.base64_encode($rsp).'">
									<span class="icon-eye"></span>
								</a>
							</td>
							
						</tr>
					';
				}
			}
			echo "</table>";	
		}
	}

	if (isset($_POST["sendProyectoOrResponsable2"])) {

		$nombreProyecto=$_POST["sendProyectoOrResponsable2"];

		if ($nombreProyecto=="") {

			$consulta_proyectos="SELECT * FROM planes_tacticos
			INNER JOIN responsables ON planes_tacticos.responsable = responsables.idResponsable ORDER BY planes_tacticos.plan ASC";
			$resultado=$conexion->prepare($consulta_proyectos);
			$resultado->execute();

			echo '
					<table class="table table-bordered">
						<thead id="proyectos" class="thead-dark">
							<tr>
								<th style="width:8%;">Estado</th>
								<th style="width:18%;">Nombre del Proyecto</th>
								<th style="width:18%;">Responsable</th>
								<th style="width:9%;">Fecha Inicio</th>
								<th style="width:9%;">Fecha Final</th>
								<th style="width:14%;">Nivel de Avance</th>
								<th style="width:14%;">Controles</th>
							</tr>
						</thead>
				';
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
			echo "</table>";
		}
		else {
			$consulta_proyectos="SELECT * FROM planes_tacticos
			INNER JOIN responsables ON planes_tacticos.responsable = responsables.idResponsable
			WHERE planes_tacticos.plan LIKE '%$nombreProyecto%' OR responsables.primerNombre LIKE '%$nombreProyecto%' OR responsables.primerApellido LIKE '%$nombreProyecto%'";
			$resultado=$conexion->prepare($consulta_proyectos);
			$resultado->execute();
			$numColum=0;

			echo '
					<table class="table table-bordered">
						<thead id="proyectos" class="thead-dark">
							<tr>
								<th style="width:8%;">Estado</th>
								<th style="width:18%;">Nombre del Proyecto</th>
								<th style="width:18%;">Responsable</th>
								<th style="width:9%;">Fecha Inicio</th>
								<th style="width:9%;">Fecha Final</th>
								<th style="width:14%;">Nivel de Avance</th>
								<th style="width:14%;">Controles</th>
							</tr>
						</thead>
				';
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
				if ($row_pla["estadoPlan"]=="3" OR $row_pla["estadoPlan"]=="4") {
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
			echo "</table>";	
		}
	}

	/*dibujar()*/

	if (isset($_POST["sendidPlan"])) {

		$dato=$_POST["sendidPlan"];
		$plan=$_POST["sendnombrePlan"];
		$responsable=$_POST["sendresponsable"];

		/*CONSULTA PARA LLAMAR A LOS ALCANCES QUE CORRESPONDEN AL PLAN TACTICO QUE VIENE POR LA URL*/
		
		$i=0;

		$consulta_detallada="SELECT * FROM alcances
		INNER JOIN planes_tacticos ON alcances.planTactico = planes_tacticos.idPlan
		WHERE alcances.planTactico = '$dato'";
		$resultado=$conexion->prepare($consulta_detallada);
		$resultado->execute();
		$u=0;
		while ($obj=$resultado->fetch(PDO::FETCH_ASSOC)) {
			$e=0;
			/*CONSULTA DE LOS PARTICIPANTES QUE CORRESPONDEN A LOS ALCANCES CONCULTADOS ANTERIORMENTE
			QUE A SU VEZ PERTENECEN A UN PLAN QUE VIENE POR AL URL*/
			$idAlcance[$u]=$obj["idAlcance"];
			$porciento[$u]=$obj["porcentajeAlcance"];
			$importancia[$u]=$obj["importancia"];
			$obj["idAlcance"];
			$estadoAlcPar=1;

			$fechasInicio[$u]=$obj["fechaInicioAlc"];
			$fechasFinal[$u]=$obj["fechaFinalAlc"];
			$fechaStart[$u]=$obj["fechaStart"];
			$fechaFinish[$u]=$obj["fechaFinish"];
			$u+=1;
			$consulta_participantes="SELECT * FROM alcances_has_cp_participantes
			INNER JOIN participantes ON participantes.idParticipante = alcances_has_cp_participantes.idParticipante
			INNER JOIN alcances ON alcances.idAlcance = alcances_has_cp_participantes.idAlcance
			WHERE alcances_has_cp_participantes.idAlcance = :idAlcance";

			$resultado_particpantes=$conexion->prepare($consulta_participantes);
			$resultado_particpantes->execute(array(':idAlcance' => $obj["idAlcance"]));

			while ($row_participantes=$resultado_particpantes->fetch(PDO::FETCH_ASSOC)) {

				$objPlanes[$obj["alcance"]][$e]=$row_participantes["primerNombre"]." ".$row_participantes["primerApellido"];
				$e+=1;
			}
			/*----------------*/
		}
		/*---------------------*/
		if (!@$objPlanes==null) {
			foreach ($objPlanes as $key[$i] => $value) {
				$i+=1;
			}
		}
		

		echo '
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th class="text-center negrita" colspan="5">
							Detalles del Plan
						</th>
					</tr>
					<tr>
						<td class="negrita" style="width:25%">
							Nombre Plan
						</td>
						<td colspan="4">
							'.$plan.'
						</td>
					</tr>
					<tr>
						<td style="width:25%;" class="negrita">
							Responsable
						</td>
						<td colspan="4">
							'.$responsable.'
						</td>
					</tr>
					<tr>
						<td class="negrita" colspan="0">
							Alcances:
							<a href="#" title="Agregar Alcances" onclick="formularioEmergente();">
								<span class="icon-plus" style="float:right; margin:3px; font-size:15px; color:white; background:#1EA70B; padding:3px; border-radius:9px;"></span>
							</a>
						</td>
						<td class="negrita" colspan="0">
							Importancia
						</td>
						<td class="negrita" colspan="0">
							Fecha a Iniciar / Finalizar:
						</td>
						<td class="negrita" colspan="0">
							Fecha Inicio / Finalizo
						</td>
						<td class="negrita" colspan="0">
							Participantes
						</td>
						
					</tr>
				</thead>
		';
		if (isset($key)) {
			for ($a=0; $a < count($key); $a++) {
				$row=count($objPlanes[$key[$a]])+1;

				if ($row<=1) {
					$row=2;
				}

				echo '
					<tr>
						<td class=" align-middle" rowspan="'.$row.'">
							<a href="#" onclick="detallarAlcance('.$idAlcance[$a].')">'.$key[$a].'</a>
							<div class="progress-wuil">
								<div class="progress-bar-wuil procentaje-'.$porciento[$a].'" style="width: '.$porciento[$a].'%;">
									'.$porciento[$a].'.%
								</div>
							</div>
						</td>
						<td rowspan="'.$row.'" class="align-middle">
							'.$importancia[$a].'
						</td>
						<td style="width:18%" class=" align-middle" rowspan="'.$row.'">
							<b>Inicio: </b>'.$fechasInicio[$a].' <br>
							<b>Final: </b>'.$fechasFinal[$a].'
						</td>
						<td style="width:18%" class=" align-middle" rowspan="'.$row.'">
							<b>Inicio: </b> '.$fechaStart[$a].' <br>
							<b>Final: </b>'.$fechaFinish[$a].'
						</td>
						
					</tr>
					';

				$var=$key[$a];
				for ($o=0; $o < count($objPlanes[$var]); $o++) {
					if (count($objPlanes[$var])<=1) {
						echo '
							<tr>
								<td colspan="2">
									'.$objPlanes[$var][$o].'
								</td>
							</tr>
						';
					}
					else{
						echo '
							<tr>
								<td>
									'.$objPlanes[$var][$o].'
								</td>
							</tr>
						';
					}
				}		
			}
		}
		else{
			echo '
			<tr>
				<td colspan="5" class="text-center">Este Proyecto no tiene Avances Registrados</td>
			</tr>
			';
		}
		
	}

	if (isset($_POST["sendResponsableId"])) {

		$idResponsable=$_POST["sendResponsableId"];

		/*Consulta para traer los datos de los Responsable*/
		/*INICIO -- INICIO -- INICIO -- INICIO -- INICIO*/
		$consulta_responsable="SELECT * FROM responsables
		WHERE idResponsable='$idResponsable'";
		$resultado_responsable=$conexion->prepare($consulta_responsable);
		$resultado_responsable->execute();

		while ($row_head=$resultado_responsable->fetch(PDO::FETCH_ASSOC)) {
			$nombre=$row_head["primerNombre"].' '.$row_head["primerApellido"];
			echo '
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th colspan="4">
								Informacion del Responsable
							</th>
						</tr>
					</thead>
					<tr>
						<td style="width:20%">
							<b>Nombre del Responsable</b>
						</td>
						<td colspan="3">
							<a href="#" title="Remplazar Responsable" class="align-middle" onclick="formularioEmergente()">
								<span class="icon-loop2" style="margin:3px; font-size:15px; color:white; background:#1EA70B; padding:3px; border-radius:9px;"></span>
							</a>
							 '.$nombre.'
							<a style="float:right; margin-right:5px; background:#353535; padding:2px; border-radius:20%; width:17px;" href="#" title="Activar y Desactivar" class="align-middle" onclick="onOffResponsable('.$idResponsable.')">
								<span class="icon-switch" style="color:red"></span>
							</a>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							Proyectos Asignados:
						</td>
					</tr>
					<tr>
					<td style="width:25%">
						<b>Proyecto</b>
					</td>
					<td colspan="2">
						<b>Avance</b>
					</td>
					<td style="width:25%">
						<b>Estado</b>
					</td>
				</tr>
			';
		}
		/*FIN -- FIN -- FIN -- FIN -- FIN -- FIN -- FIN*/
		/*Consulta para traer los datos de los Responsable*/
		

		/*Consulta para traer los datos de los PlanesTacticos*/
		/*INICIO -- INICIO -- INICIO -- INICIO -- INICIO*/
		$consulta="SELECT * FROM planes_tacticos
		WHERE responsable='$idResponsable'";
		$resultado=$conexion->prepare($consulta);
		$resultado->execute();
		$i=0;
		/*FIN -- FIN -- FIN -- FIN -- FIN -- FIN -- FIN*/
		/*Consulta para traer los datos de los PlanesTacticos*/

	
		while ($row_plan=$resultado->fetch(PDO::FETCH_ASSOC)) {

			switch ($row_plan["estadoPlan"]) {
				case '0':
					$estado="Sin Iniciar";
					break;
				case '1':
					$estado="En Ejecucion";
					break;
				case '2':
					$estado="Pausado";
					break;
				case '3':
					$estado="Cancelado";
					break;
			}
			$i+=1;
			echo '
				<tr>
					<td>
					<a href="detallePlan.php?id='.base64_encode($row_plan["idPlan"]).'&plan='.base64_encode($row_plan["plan"]).'&fechaInicio='.base64_encode($row_plan["fechaInicio"]).'&fechaFinal='.base64_encode($row_plan["fechaFinal"]).'&responsable='.base64_encode($nombre).'">
						'.$row_plan["plan"].'
					</a>
						
					</td>
					<td colspan="2">
						<div class="progress-wuil">
							<div class="progress-bar-wuil procentaje-'.$row_plan["avance"].'" style="width: '.$row_plan["avance"].'%;">
								'.$row_plan["avance"].'%
							</div>
						</div>
					</td>
					<td>
						'.$estado.'
					</td>
					
				</tr>			
			';
			
		}
		if (!$i>=1) {
			echo '
				<tr>
					<td colspan="4">
						Este Responsable no tiene Proyectos Asignados
					</td>
				</tr>
			';
		}
		echo '<table>';
	}
	if (isset($_POST["sendValueResponsable"])) {
		
		$valor=$_POST["sendValueResponsable"];

		if ($valor=="") {
			$consulta="SELECT * FROM responsables";
			$resultado=$conexion->prepare($consulta);
			if($resultado->execute()){
				echo '
					<ul class="ul-responsables">
				';
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
				echo '
					</ul>
				';
			}
		}
		else{
			$consulta="SELECT * FROM responsables
			WHERE primerNombre LIKE '%$valor%' OR primerApellido LIKE '%$valor%'";
			$resultado=$conexion->prepare($consulta);
			if($resultado->execute()){
				echo '
					<ul class="ul-responsables">
				';
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
				echo '
					</ul>
				';
			}
		}
		
	}
?>