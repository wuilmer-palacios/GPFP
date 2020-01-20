<?php

	include('../conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");
	$conexion->exec("set names utf8");
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
	
	if (isset($_POST["sendPaticipante"])) {
		
		$idAlcance=NULL;
		$alcance=$_POST["sendNomAlcance"];	
		$planTactico=$_POST["sendIdPlan"];
		$fechaInicio=$_POST["sendFecInicioAlcance"];
		$fechaFinal=$_POST["sendFecFinalAlcance"];
		$estadoAlcance=0;
		$participantes=$_POST["sendPaticipante"];
	

		$consulta="INSERT INTO alcances (idAlcance, alcance, planTactico, fechaInicio, fechaFinal, estadoAlcance) VALUES (:idAlcance, :alcance, :planTactico, :fechaInicio, :fechaFinal, :estadoAlcance)";
		$resultado=$conexion->prepare($consulta);
		if ($resultado->execute(array(
			':idAlcance' => $idAlcance,
			':alcance' => $alcance,
			':planTactico' => $planTactico,
			':fechaInicio' => $fechaInicio,
			':fechaFinal' => $fechaFinal,
			':estadoAlcance' => $estadoAlcance
			 ))) {
	
			$consultaUltimoAlcance="SELECT * FROM alcances ORDER BY idAlcance DESC LIMIT 1";
			$resultadoUltimoAlcance=$conexion->prepare($consultaUltimoAlcance);
			$resultadoUltimoAlcance->execute();

			while ($row_ultimo=$resultadoUltimoAlcance->fetch(PDO::FETCH_ASSOC)) {
				
				for ($i=0; $i < count($participantes); $i++) { 
					
					$row_ultimo["idAlcance"];
					$participantes[$i];

					$consulta_unir="INSERT INTO alcances_has_cp_participantes (idAlcance, idParticipante) VALUES (:idAlcance, :idParticipante)";
					$resultado_unir=$conexion->prepare($consulta_unir);

					if ($resultado_unir->execute(array(
						':idAlcance' => $row_ultimo["idAlcance"],
						':idParticipante' => $participantes[$i]))) {
					}

				}

				$consulta_participantes="SELECT * FROM alcances_has_cp_participantes
				INNER JOIN alcances ON alcances.idAlcance = alcances_has_cp_participantes.idAlcance
				INNER JOIN participantes ON participantes.idParticipante = alcances_has_cp_participantes.idParticipante
				WHERE alcances_has_cp_participantes.idAlcance=:idAlcance";
				$resultado_participantes=$conexion->prepare($consulta_participantes);
				$resultado_participantes->execute(array(':idAlcance' => $row_ultimo["idAlcance"]));
				while ($datos=$resultado_participantes->fetch(PDO::FETCH_ASSOC)) {
					
					@$e+=1;
					
					if ($e==1) {
						echo $datos["alcance"]."*";
						echo $datos["fechaInicio"]."*";
						echo $datos["fechaFinal"]."*";
					}
					
					$nombre[$e-1]=$datos["primerNombre"]." ".$datos["primerApellido"]."|";
					echo $nombre[$e-1];
				}
			}
		}
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