<?php

	include('../conexion.php');

	$conexion= new Conexion();

	if (@$_POST["tipo"]=="responsable") {

		$error=false;

		if ($_POST["primerNombre"]=="") {
			$error=true;
		}
		
		if ($_POST["primerApellido"]=="") {
			$error=true;
		}

		while ($error==false) {

			$cod=null;
			$primerNombre=$_POST["primerNombre"];
			$segundoNombre=$_POST["segundoNombre"];
			$primerApellido=$_POST["primerApellido"];
			$segundoApellido=$_POST["segundoApellido"];
			$estado=1;
			
			$consulta="INSERT INTO responsables (idResponsable, primerNombre, segundoNombre, primerApellido, segundoApellido, estadoResponsable) VALUES ('$cod','$primerNombre', '$segundoNombre', '$primerApellido', '$segundoApellido', '$estado')";
			
			$resultado=$conexion->prepare($consulta);
			if ($resultado->execute()) {

				echo "1";
			}
			else{

				echo "0";
			}
			$error=true;		
		}
	}

	if (isset($_POST["sendUltimo"])) {
		$consulta="SELECT *FROM responsables ORDER by idResponsable DESC LIMIT 1";
		$resultado=$conexion->prepare($consulta);
		$resultado->execute();

		while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) {
			echo $row["primerNombre"]." ".$row["segundoNombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"];
		}
	}

	// /*-----------------*/++/*-----------------*/
	// /*-----------------*/++/*-----------------*/
	if (@$_POST["tipo"]=="participante") {

		$error=false;

		if ($_POST["primerNombre"]=="") {
			$error=true;
		}
		
		if ($_POST["primerApellido"]=="") {
			$error=true;
		}

		while ($error==false) {

			$cod=null;
			$primerNombre=$_POST["primerNombre"];
			$segundoNombre=$_POST["segundoNombre"];
			$primerApellido=$_POST["primerApellido"];
			$segundoApellido=$_POST["segundoApellido"];
			$estado=1;
			
			$consulta="INSERT INTO participantes (idParticipante, primerNombre, segundoNombre, primerApellido, segundoApellido, estadoParticipante) VALUES ('$cod','$primerNombre', '$segundoNombre', '$primerApellido', '$segundoApellido', '$estado')";
			
			$resultado=$conexion->prepare($consulta);
			if ($resultado->execute()) {

				echo "1";
			}
			else{

				echo "0";
			}
			$error=true;		
		}
	}

	if (isset($_POST["sendUltimoParticipante"])) {
		$consulta="SELECT *FROM participantes ORDER by idParticipante DESC LIMIT 1";
		$resultado=$conexion->prepare($consulta);
		$resultado->execute();

		while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) {
			echo $row["primerNombre"]." ".$row["segundoNombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"];
		}
	}
	
	// /*-----------------*/++/*-----------------*/
	// /*-----------------*/++/*-----------------*/

	if (@$_POST["tipo"]=="nuevoPlanTactico") {

		$idPlan='NULL';
		$estrategia='NULL';
		$nombrePlan=$_POST["nombrePlan"];
		$fechaIni=$_POST["fechaInicio"];
		$fechaFin=$_POST["fechaFinal"];
		$responsable=$_POST["responsable"];
		$estadoPlan=1;
		$fechaInicio=str_replace("/","-", $fechaIni)." 00:00:00";
		$fechaFinal=str_replace("/","-",$fechaFin)." 00:00:00";



		$consulta="INSERT INTO planes_tacticos (idPlan, estrategia, plan, fechaInicio, fechaFinal, responsable, estadoPlan) VALUES ('$idPlan', '$estrategia', '$nombrePlan', '$fechaInicio', '$fechaFinal', '$responsable', '$estadoPlan')";
		$resultado=$conexion->prepare($consulta);

		if ($resultado->execute()) {

			echo "1";
		}
		else{

			echo "0";
		}
	}
		
?>