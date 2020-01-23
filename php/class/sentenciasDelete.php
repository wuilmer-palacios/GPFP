<?php

	include('../conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");
	$conexion->exec("set names utf8");

	if (isset($_POST["sendIdParticipante"])) {
		
		$idAlcance=$_POST["sendIdAlcance"];
		$idParticipante=$_POST["sendIdParticipante"];

		$sentencia_delete="DELETE FROM alcances_has_cp_participantes
		WHERE idAlcance=:idAlcance AND idParticipante=:idParticipante";

		$resultado=$conexion->prepare($sentencia_delete);
		$saber=$resultado->execute(array(
			':idAlcance' => $idAlcance,
			':idParticipante' => $idParticipante
		));

		if ($saber==true) {

			echo '<ol id="lista-historial" style="padding-left:15px;" class="lista-historial">';
			$consulta_list="SELECT * FROM alcances_has_cp_participantes
			INNER JOIN participantes ON alcances_has_cp_participantes.idParticipante = participantes.idParticipante
			WHERE alcances_has_cp_participantes.idAlcance = :idAlcance AND alcances_has_cp_participantes.estadoAlcPar=1";
			$resultado_list=$conexion->prepare($consulta_list);
			$resultado_list->execute(array(':idAlcance' => $idAlcance ));

			while ($row_participante=$resultado_list->fetch(PDO::FETCH_ASSOC)) {
				$nombre=$row_participante["primerNombre"]." ".$row_participante["primerApellido"];
				echo '
						<li style="padding:5px 10px;">
							'.$nombre.'
							<a href="#" onclick="confirmar('.$row_participante["idParticipante"].');">
								<span style="float:right;" class="icon-bin icon-bin-wuil"></span>
							</a>
							
						</li>
				';
			}
				echo '
						<li style="padding:5px 10px; list-style:none">
							<hr>
						</li>
					';
				echo "</ol>";
		}
	}

?>