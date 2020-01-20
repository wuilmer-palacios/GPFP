
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

				echo '
					<tr>
						<td>
							'.$row_pla["plan"].'
						</td>
						<td>
							'.$row_pla["primerNombre"].' '.$row_pla["primerApellido"].'
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
							<a href=""><span class="icon-eye"></span></a>
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

				echo '
					<tr>
						<td>
							'.$row_pla["plan"].'
						</td>
						<td>
							'.$row_pla["primerNombre"].' '.$row_pla["primerApellido"].'
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
							<a href=""><span class="icon-eye"></span></a>
						</td>
						
					</tr>
				';
			}
			echo "</table>";	
		}
	}
?>