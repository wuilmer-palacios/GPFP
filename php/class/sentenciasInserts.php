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

			$consulta="SELECT *FROM planes_tacticos ORDER by idPlan DESC LIMIT 1";
			$resultado=$conexion->prepare($consulta);
			$resultado->execute();

			while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) {
				echo $row["idPlan"];
			}
		}
		else{

			echo "0";
		}
	}
/*-------------------------------------*/
	@$valores=explode("&", $_POST["valores"]);

	for ($i=0; $i < count($valores); $i++) {

		$subValor[$i]=explode("=", $valores[$i]);

		@$valor[$subValor[$i][0]]=$subValor[$i][1];
	}
	
	if (@$valor["tipo"]=="nuevoAlcance") {

		echo "<br>".$idAlcance=NULL;
		echo "<br>".$alcance=str_replace("%20", " ", $valor["nombreAlcance"]);
		echo "<br>".$planTactico=$valor["idPlan"];
		echo "<br>".$fechaInicio=$valor["fechaInicioAlcance"];
		echo "<br>".$fechaFinal=$valor["fechaFinalAlcance"];
		echo "<br>".$estadoAlcance=1;

		

		$consulta="INSERT INTO alcances (idAlcance, alcance, planTactico, fechaInicio, fechaFinal, estadoAlcance) VALUES (:idAlcance, :alcance, :planTactico, :fechaInicio, :fechaFinal, :estadoAlcance)";
		$resultado=$conexion->prepare($consulta);
		$resultado->execute(array(
			':idAlcance' => $idAlcance,
			':alcance' => $alcance,
			':planTactico' => $planTactico,
			':fechaInicio' => $fechaInicio,
			':fechaFinal' => $fechaFinal,
			':estadoAlcance' => $estadoAlcance
			 ));

		@$participantes=$_POST["participantes"];
	}
/*k------------------------------------*/
	if (@$_POST["senUltimoRegistro"]>=1) {

		$idPlan=$_POST["senUltimoRegistro"];
		$estadoPlan=1;
		
		$sentecia="SELECT * FROM planes_tacticos 
		INNER JOIN responsables ON planes_tacticos.responsable = responsables.idResponsable
		WHERE planes_tacticos.idPlan=:idPlan AND planes_tacticos.estadoPlan=:estadoPlan";
		$resultado=$conexion->prepare($sentecia);

		if ($resultado->execute(array(':idPlan' => $idPlan, ':estadoPlan' => $estadoPlan))) {
			
			while ($row_plan=$resultado->fetch(PDO::FETCH_ASSOC)) {
				
				echo $row_plan["idPlan"]."-".$row_plan["plan"]."-".$row_plan["primerNombre"]." ".$row_plan["primerApellido"];
			}
		}

	}
?>