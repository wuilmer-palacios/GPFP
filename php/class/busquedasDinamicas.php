
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
								<th style="width:20%;">Nombre del Proyecto</th>
								<th style="width:20%;">Responsable</th>
								<th style="width:10%;">Fecha Inicio</th>
								<th style="width:10%;">Fecha Final</th>
								<th style="width:35%;">Nivel de Avance</th>
								<th style="width:5%;">Detallar</th>
							</tr>
						</thead>
				';
			while ($row_pla=$resultado->fetch(PDO::FETCH_ASSOC)) {
				$rsp=$row_pla["primerNombre"].' '.$row_pla["primerApellido"];
				echo '
					<tr>
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
								<div class="progress-bar-wuil procentaje-5" style="width: 5%;">
									5%
								</div>
							</div>
						</td>
						<td class="align-middle text-center">
							<a href="detallePlan.php?id='.base64_encode($row_pla["idPlan"]).'&plan='.base64_encode($row_pla["plan"]).'&responsable='.base64_encode($rsp).'">
								<span class="icon-eye"></span>
							</a>
						</td>
						
					</tr>
				';
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
								<th style="width:20%;">Nombre del Proyecto</th>
								<th style="width:20%;">Responsable</th>
								<th style="width:10%;">Fecha Inicio</th>
								<th style="width:10%;">Fecha Final</th>
								<th style="width:35%;">Nivel de Avance</th>
								<th style="width:5%;">Detallar</th>
							</tr>
						</thead>
				';
			while ($row_pla=$resultado->fetch(PDO::FETCH_ASSOC)) {
				$rsp=$row_pla["primerNombre"].' '.$row_pla["primerApellido"];
				echo '
					<tr>
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
								<div class="progress-bar-wuil procentaje-5" style="width: 5%;">
									5%
								</div>
							</div>
						</td>
						<td class="align-middle text-center">
							<a href="detallePlan.php?id='.base64_encode($row_pla["idPlan"]).'&plan='.base64_encode($row_pla["plan"]).'&responsable='.base64_encode($rsp).'">
								<span class="icon-eye"></span>
							</a>
						</td>
						
					</tr>
				';
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
			$obj["idAlcance"];

			$fechasInicio[$u]=$obj["fechaInicioAlc"];
			$fechasFinal[$u]=$obj["fechaFinalAlc"];
			$u+=1;
			$consulta_participantes="SELECT * FROM alcances_has_cp_participantes
			INNER JOIN participantes ON participantes.idParticipante = alcances_has_cp_participantes.idParticipante
			INNER JOIN alcances ON alcances.idAlcance = alcances_has_cp_participantes.idAlcance
			WHERE alcances_has_cp_participantes.idAlcance = :idAlcance";

			$resultado_particpantes=$conexion->prepare($consulta_participantes);
			$resultado_particpantes->execute(array(':idAlcance' => $obj["idAlcance"] ));

			while ($row_participantes=$resultado_particpantes->fetch(PDO::FETCH_ASSOC)) {

				$objPlanes[$obj["alcance"]][$e]=$row_participantes["primerNombre"]." ".$row_participantes["primerApellido"];
				$e+=1;
			}
			/*----------------*/
		}
		/*---------------------*/
		foreach ($objPlanes as $key[$i] => $value) {
			$i+=1;
		}

		echo '
			<table class="table table-bordered">
				<thead class="thead-dark">
					<tr>
						<th class="text-center negrita" colspan="4">
							Detalles del Plan
						</th>
					</tr>
					<tr>
						<td class="negrita" style="width:25%">
							Nombre Plan
						</td>
						<td colspan="3">
							'.$plan.'
						</td>
					</tr>
					<tr>
						<td style="width:25%;" class="negrita">
							Responsable
						</td>
						<td colspan="3">
							'.$responsable.'
						</td>
					</tr>
					<tr>
						<td class="negrita" colspan="0">
							Alcances:
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

		for ($a=0; $a < count($key); $a++) {
			$row=count($objPlanes[$key[$a]])+1;

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
					<td style="width:18%" class=" align-middle" rowspan="'.$row.'">
						Inicio:'.$fechasInicio[$a].' <br>
						Final: '.$fechasFinal[$a].'
					</td>
					<td style="width:18%" class=" align-middle" rowspan="'.$row.'">
						Inicio:01 de Enero 2020 <br>
						Final: 30 de Enero 2020:
					</td>
					
				</tr>
				';
				$var=$key[$a];
				for ($o=0; $o < count($objPlanes[$var]); $o++) { 
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
?>