<?php
	
	include('../conexion.php');
	$conexion= new Conexion();

	if (isset($_POST["sendNombrePlan"])) {
		
		$nombrePlan=$_POST["sendNombrePlan"];

		$consultaNombre="SELECT count(*) FROM planes_tacticos WHERE plan='$nombrePlan'";
		$resultado=$conexion->query($consultaNombre);
		$numRow=$resultado->fetchColumn();
		echo $numRow;


	}

?>