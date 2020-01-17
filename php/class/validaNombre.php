<?php
	
	include('../conexion.php');
	$conexion= new Conexion();

	/*EN ESTE TROZO DE CODIGO SE RECIBE EL NOMBRE DEL PLAN TACTICO QUE HA INTRODUCIDO EL USUARIO
	Y SE LLEVA HASTA LA BASE DE DATOS PARA COMPRARA SI YA EXISTE UN NOMBRE IGUAL*/
	if (isset($_POST["sendNombrePlan"])) {
		
		$nombrePlan=$_POST["sendNombrePlan"];

		$consultaNombre="SELECT count(*) FROM planes_tacticos WHERE plan='$nombrePlan'";
		$resultado=$conexion->query($consultaNombre);
		$numRow=$resultado->fetchColumn();
		echo $numRow;
	}
	/*-----------------------------------------------------------------------------------------*/

	/*EN ESTE TROZO DE CODIGO SE RECIBE EL NOMBRE DE LOS ALCANCES QUE HA INTRODUCIDO EL USUARIO
	Y SE LLEVA HASTA LA BASE DE DATOS PARA COMPRARA SI YA EXISTE UN NOMBRE IGUAL*/
	if (isset($_POST["sendNombreAlcance"])) {
		
		$nombreAlcance=$_POST["sendNombreAlcance"];
		$idPlan=$_POST["sendIdPlan"];

		$consultaNombre="SELECT count(*) FROM alcances WHERE alcance='$nombreAlcance' AND planTactico ='$idPlan'";
		$resultado=$conexion->query($consultaNombre);
		$numRow=$resultado->fetchColumn();
		echo $numRow;
	}

?>