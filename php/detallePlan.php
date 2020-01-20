<?php

	include('conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");
	$dato=base64_decode($_GET["id"]);

	if (!isset($dato)) {
		header("Location:../");
	}
	else{
		$consulta_detallada="SELECT * FROM alcances
		INNER JOIN planes_tacticos ON alcances.planTactico = planes_tacticos.idPlan
		WHERE alcances.planTactico = '$dato'";
		$resultado=$conexion->prepare($consulta_detallada);
		
		if ($resultado->execute()) {
			$e=0;
			$i=0;
			$allParticipante=null;
			while ($row_alcances=$resultado->fetch(PDO::FETCH_ASSOC)) {

				$alcances[$e]=$row_alcances["idAlcance"];
				$row_alcances["idAlcance"].$row_alcances["alcance"]."<br>";

				$consulta_participantes="SELECT * FROM alcances_has_cp_participantes
				INNER JOIN participantes ON alcances_has_cp_participantes.idParticipante = participantes.idParticipante
				WHERE alcances_has_cp_participantes.idAlcance = :alcance";
				$result=$conexion->prepare($consulta_participantes);
				$result->execute(array(':alcance' => $alcances[$e] ));

				while ($row_participante=$result->fetch(PDO::FETCH_ASSOC)) {
					$nombre=$row_participante["primerNombre"]." ".$row_participante["primerApellido"]."<br>";


					if (!in_array($nombre, $allParticipante)) {
						$allParticipante[$i]=$nombre;
					}
					
					$i+=1;
				}
				$e+=1;
			}
			echo "<pre>";
			var_dump($allParticipante);
			echo "</pre>";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Gestor de Proyectos</title>
	<meta charset="utf-8">
</head>
<body>
	<table>
		<thead>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</thead>
	</table>
</body>
</html>