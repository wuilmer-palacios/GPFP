<?php

	include('../conexion.php');
	$GLOBALS['conexion'] = new Conexion();
	$GLOBALS['conexion'] ->exec("set names utf8");

	function actualizaPorcentajePlan($valor1){

		$idPlan=$valor1;

		$consulta_suma="SELECT SUM(porcentajeAlcance) AS total_suma FROM alcances
		WHERE planTactico=:planTactico";
		$resultado_suma=$GLOBALS['conexion']->prepare($consulta_suma);
		$resultado_suma->execute(array(':planTactico' => $idPlan ));

		$row=$resultado_suma->fetch(PDO::FETCH_ASSOC);

		$total_suma=$row["total_suma"];

		$consulta_count="SELECT COUNT(*) AS total_count FROM alcances
		WHERE planTactico=:planTactico";
		$resultado_count=$GLOBALS['conexion']->prepare($consulta_count);
		$resultado_count->execute(array(':planTactico' => $idPlan ));;

		$row_count=$resultado_count->fetch(PDO::FETCH_ASSOC);

		$total_count=$row_count["total_count"];
		
		$porcentajeFinal=floor($porcentajeFinal=$total_suma/$total_count);
		
		$update="UPDATE planes_tacticos
		SET avance='$porcentajeFinal'
		WHERE idPlan=:idPlan";

		$resultado_update=$GLOBALS['conexion']->prepare($update);
		$resultado_update->execute(array(':idPlan' => $idPlan ));
	}

	if (isset($_POST["sendOnOff"]) && $_POST["sendOnOff"]==1) {

		$consulta_general="SELECT * FROM planes_tacticos";
		$resultado=$GLOBALS['conexion']->prepare($consulta_general);
		if ($resultado->execute()) {

			while ($row_gen=$resultado->fetch(PDO::FETCH_ASSOC)) {
				
				 actualizaPorcentajePlan($row_gen["idPlan"]);
			}

		}	
	}
	
?>