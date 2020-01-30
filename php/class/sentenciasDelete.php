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

	if (isset($_POST["sendStop"])) {
		
		$idPlan=$_POST["sendStop"];

		$consulta_estado="UPDATE planes_tacticos
		SET estadoPlan=4
		WHERE idPlan='$idPlan'";

		$resultado=$conexion->prepare($consulta_estado);
		$saber=$resultado->execute();
		if ($saber) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	if (isset($_POST["sendPause"])) {
		
		$idPlan=$_POST["sendPause"];

		$consulta_estado="UPDATE planes_tacticos
		SET estadoPlan=3
		WHERE idPlan='$idPlan'";

		$resultado=$conexion->prepare($consulta_estado);
		$saber=$resultado->execute();
		if ($saber) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	if (isset($_POST["sendPlay"])) {
		
		$idPlan=$_POST["sendPlay"];

		$consulta_estado="UPDATE planes_tacticos
		SET estadoPlan=0
		WHERE idPlan='$idPlan'";

		$resultado=$conexion->prepare($consulta_estado);
		$saber=$resultado->execute();
		if ($saber) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	if (isset($_POST["sendIdNew"]) && isset($_POST["sendIdOld"])) {
		
		$sendIdNew=$_POST["sendIdNew"];
		$sendIdOld=$_POST["sendIdOld"];

		$consulta_update="UPDATE planes_tacticos
		SET responsable = '$sendIdNew'
		WHERE responsable = '$sendIdOld'";
		$resultado=$conexion->prepare($consulta_update);
		if($resultado->execute()){
			echo "1";
		}
	}

	if (isset($_POST["sendOnOffResponsable"])) {
		$idResponsable=$_POST["sendOnOffResponsable"];
		
		$consulta_estado="SELECT estadoResponsable AS estado FROM responsables
		WHERE idResponsable = '$idResponsable'";
		$resultado_estado=$conexion->prepare($consulta_estado);
		$resultado_estado->execute();
		$row=$resultado_estado->fetch(PDO::FETCH_ASSOC);
		$row["estado"];

		switch ($row["estado"]) {
			case '0':
				$consulta_update="UPDATE responsables
				SET estadoResponsable=1
				WHERE idResponsable=:idResponsable";
				$resultado=$conexion->prepare($consulta_update);
				$saber=$resultado->execute(array(':idResponsable' => $idResponsable));

				if ($saber==true) {
					echo "1";
				}
				break;

			case '1':
				$consulta_update="UPDATE responsables
				SET estadoResponsable=0
				WHERE idResponsable=:idResponsable";
				$resultado=$conexion->prepare($consulta_update);
				$saber=$resultado->execute(array(':idResponsable' => $idResponsable));

				if ($saber==true) {
					echo "1";
				}
				break;
		}
	}
?>