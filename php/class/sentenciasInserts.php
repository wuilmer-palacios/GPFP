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
		$estadoPlan=0;
		$fechaInicio=str_replace("/","-", $fechaIni);
		$fechaFinal=str_replace("/","-",$fechaFin);



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
		$importancia=$_POST["sendImportancia"];
	

		$consulta="INSERT INTO alcances (idAlcance, alcance, planTactico, fechaInicioAlc, fechaFinalAlc, estadoAlcance, importancia) VALUES (:idAlcance, :alcance, :planTactico, :fechaInicio, :fechaFinal, :estadoAlcance, :importancia)";
		$resultado=$conexion->prepare($consulta);
		if ($resultado->execute(array(
			':idAlcance' => $idAlcance,
			':alcance' => $alcance,
			':planTactico' => $planTactico,
			':fechaInicio' => $fechaInicio,
			':fechaFinal' => $fechaFinal,
			':estadoAlcance' => $estadoAlcance,
			':importancia' => $importancia,
			 ))) {
	
			$consultaUltimoAlcance="SELECT * FROM alcances ORDER BY idAlcance DESC LIMIT 1";
			$resultadoUltimoAlcance=$conexion->prepare($consultaUltimoAlcance);
			$resultadoUltimoAlcance->execute();

			while ($row_ultimo=$resultadoUltimoAlcance->fetch(PDO::FETCH_ASSOC)) {
				
				for ($i=0; $i < count($participantes); $i++) { 
					
					$row_ultimo["idAlcance"];
					$participantes[$i];
					$estadoAlcPar=1;

					$consulta_unir="INSERT INTO alcances_has_cp_participantes (idAlcance, idParticipante, estadoAlcPar) VALUES (:idAlcance, :idParticipante, :estadoAlcPar)";
					$resultado_unir=$conexion->prepare($consulta_unir);

					if ($resultado_unir->execute(array(
						':idAlcance' => $row_ultimo["idAlcance"],
						':idParticipante' => $participantes[$i],
						':estadoAlcPar' => $estadoAlcPar))) {
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
						echo $datos["fechaInicioAlc"]."*";
						echo $datos["fechaFinalAlc"]."*";
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
		$estadoPlan=0;
		
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

	if (isset($_POST["sendIdAlcanceName"])) {
		
		$idAlcance=$_POST["sendIdAlcanceName"];

		$consulta_name_alcance="SELECT *  FROM alcances WHERE idAlcance=:alcance";
		$resultado=$conexion->prepare($consulta_name_alcance);
		$resultado->execute(array(':alcance' => $idAlcance ));

		while ($row_name=$resultado->fetch(PDO::FETCH_ASSOC)) {
			echo $row_name["alcance"];
		}
	}
	if (isset($_POST["sendIdAlcance"])) {
		
		$idAlcance=$_POST["sendIdAlcance"];

		$consulta="SELECT * FROM gestion_alcance
		WHERE alcance=:alcance";
		$resultado=$conexion->prepare($consulta);
		$resultado->execute(array(':alcance' => $idAlcance ));
		echo '<ol id="lista-historial" style="padding-left:15px;" class="lista-historial">';

		while ($row_sub_alcances=$resultado->fetch(PDO::FETCH_ASSOC)) {
			echo '
			<li style="padding:5px 10px;">
				'.$row_sub_alcances["gestion"].'
				<span style="float:right;" class="icon-eye"></span>
				<span class="porcentaje-list" style="float:right;">
					'.$row_sub_alcances["porcentajeGestion"].' %
				</span>
			</li>
			';
			@$total+=$row_sub_alcances["porcentajeGestion"];
		}
		echo '
			<li style="padding:5px 10px; list-style:none">
				<hr>
			</li>
			<li style="padding:5px 10px; list-style:none"" class="text-center">
				<h5 style="font-weight:900;" class="text-center">
					Avance Total= '.@$total.' %
				</h5>
			</li>
			';
		echo "</ol>";
	}
	/*231*/

	if (isset($_POST["sendgestion"])) {

		$idGestion=NULL;
		$gestion=$_POST["sendgestion"];
		$idAlcance=$_POST["sendidAlcance"];
		$usuarioGestion=NULL;
		$hoy=$_POST["sendhoy"];
		$estadoGestion=1;
		$observacion=$_POST["sendobservacion"];
		$porcentaje=$_POST["sendporcentaje"];
		$fechaStart=NULL;
		$fechaFinish=NULL;

		// EN EL SIGUIENTE PEDAZO DE CODIGO
		// 1.- PRIMERO HAGO UNA CONSULTA A LA TABLA DE gestion_alcance PARA SABER SI YA HAY ALGUNA TAREA REALACIONADA CON EL ALCACNE EN CUESTION, SI LA RESPUESTA DE LA CONSULTA ES "0" ENTONCES ACTUALIZO EL CAMPO DEL LA TABLA fechaStart DE LA TABLA alcances PARA ESPECIFICAR QUE ES LA PRMERA TAREA DEL ALCANCE Y OBTENGO LA FECHA DEL DIA ACTUAL Y LO METO EN EL CAMPO ANTES MENCIONADO.

		// 	EN CASO QUE LA CONSULTA SEA > DE "0" QUIERE DECIR QUE YA EL CAMPO fechaStart DE LA TABLA alcances YA FUE MODIFICADO

		$consulta_gestion="SELECT count(*) AS numrow FROM gestion_alcance WHERE alcance='$idAlcance'";
		$resultado_gestion=$conexion->prepare($consulta_gestion);
		$resultado_gestion->execute();
		$ges=$resultado_gestion->fetch(PDO::FETCH_ASSOC);
		$numGestion=$ges["numrow"];

		if ($numGestion=="0") {
			$hoy_ges = getdate();

			if ($hoy_ges["mon"]<="9") {
				$hoy_ges["mon"]="0".$hoy_ges["mon"];
			}
			$fechaStart=$hoy_ges["year"]."-".$hoy_ges["mon"]."-".$hoy_ges["mday"];

			$consulta_update="UPDATE alcances 
			SET fechaStart='$fechaStart'
			WHERE idAlcance='$idAlcance'";
			$resultado_update=$conexion->prepare($consulta_update);
			$resultado_update->execute();
		}

		/*FIN DE LA CONSULTA - - FIN DE LA CONSULTA - - FIN DE LA CONSULTA*/
		/*FIN DE LA CONSULTA - - FIN DE LA CONSULTA - - FIN DE LA CONSULTA*/

		/*----------------------------------------------------------------------------------------------------*/

		$consulta_porcentaje="SELECT * FROM alcances WHERE idAlcance=:idAlcance";
		$resultado_porcentaje=$conexion->prepare($consulta_porcentaje);
		$resultado_porcentaje->execute(array(':idAlcance' => $idAlcance ));

		while ($row_porcentaje=$resultado_porcentaje->fetch(PDO::FETCH_ASSOC)) {
			$porcentaje_almacenado=$row_porcentaje["porcentajeAlcance"];
			$porcen=100-$porcentaje_almacenado;
			/*Comparacion para saber si el usuario a ingregado un valor correcto*/
			if ($porcentaje>=0 && $porcentaje<=$porcen) {
		
				$consulta_insert="INSERT INTO gestion_alcance (idGestion, gestion, alcance, usuarioGestion, fechaGestion, estadoGestion, observaciones, porcentajeGestion) VALUES (:idGestion, :gestion, :alcance, :usuarioGestion, :fechaGestion, :estadoGestion, :observaciones, :porcentajeGestion)";

				$resultado_insert=$conexion->prepare($consulta_insert);
				
				$saber=$resultado_insert->execute(array(
					':idGestion' => $idGestion,
					':gestion' => $gestion,
					':alcance' => $idAlcance,
					':usuarioGestion' => $usuarioGestion,
					':fechaGestion' => $hoy,
					':estadoGestion' => $estadoGestion,
					':observaciones' => $observacion,
					':porcentajeGestion' => $porcentaje
				));

				if ($saber) {
					$consulta="SELECT * FROM gestion_alcance
					WHERE alcance=:alcance";
					$resultado=$conexion->prepare($consulta);
					$resultado->execute(array(':alcance' => $idAlcance ));

					echo '<ol id="lista-historial" style="padding-left:15px;" class="lista-historial">';
					$row_sub_alcances=0;

					while ($row_sub_alcances=$resultado->fetch(PDO::FETCH_ASSOC)) {
						echo '
						<li style="padding:5px 10px;">
							'.$row_sub_alcances["gestion"].'
							<span style="float:right;" class="icon-eye"></span>
							<span class="porcentaje-list" style="float:right;">
								'.$row_sub_alcances["porcentajeGestion"].' %
							</span>
						</li>
						';
						@$total+=$row_sub_alcances["porcentajeGestion"];
					}
					echo '
						<li style="padding:5px 10px; list-style:none">
							<hr>
						</li>
						<li style="padding:5px 10px; list-style:none"" class="text-center">
							<h5 style="font-weight:900;" class="text-center">
								Avance Total= '.$total.' %
							</h5>
						</li>
						
					';
					echo "</ol>";

					/*EN ESTE PEDAZO DE CODIGO DETERMINO SI EL ALCANCE YA LLEGO A SU 100% EN CASO QUE LA RESPUESTA SEA true.
					ACTUALIZO EL CAMPO fechaFinish QUE CORRESPONDE A LA TABLA alcances PARA ESTABLECER LA FECHA EN LA QUE ESE ALCANCE YA ALCACNZO SU 100% */

					if ($total=="100") {

						$hoy_ges = getdate();

						if ($hoy_ges["mon"]<="9") {
							$hoy_ges["mon"]="0".$hoy_ges["mon"];
						}
						$fechaFinish=$hoy_ges["year"]."-".$hoy_ges["mon"]."-".$hoy_ges["mday"];

						$consulta_update_final="UPDATE alcances
						SET fechaFinish='$fechaFinish'
						WHERE idAlcance='$idAlcance'";
						$resultado_update_final=$conexion->prepare($consulta_update_final);
						$resultado_update_final->execute();
					}
					/*FIN DE LA CONSULTA - - FIN DE LA CONSULTA - - FIN DE LA CONSULTA*/
					/*FIN DE LA CONSULTA - - FIN DE LA CONSULTA - - FIN DE LA CONSULTA*/
					/*----------------------------------------------------------------------------------------------------*/

					/**/
					$valorFinal=$porcentaje_almacenado+$porcentaje;
					$consulta_update="UPDATE alcances 
					SET porcentajeAlcance='$valorFinal'
					WHERE idAlcance='$idAlcance'";
					$resultadoFinal=$conexion->prepare($consulta_update);
					$resultadoFinal->execute();

				}
			}
			else{
				echo "1";
			}
		}
	}

	if (isset($_POST["sendIdAlcanceParticipantes"])) {
		
		$idAlcance=$_POST["sendIdAlcanceParticipantes"];
		$consulta_participantes="SELECT * FROM alcances_has_cp_participantes
		INNER JOIN participantes ON participantes.idParticipante = alcances_has_cp_participantes.idParticipante
		WHERE alcances_has_cp_participantes.idAlcance = :alcance";
		$resultado=$conexion->prepare($consulta_participantes);

		if($resultado->execute(array(':alcance' => $idAlcance ))){

			echo '<ol id="lista-historial" style="padding-left:15px;" class="lista-historial">';
			while ($row_participante=$resultado->fetch(PDO::FETCH_ASSOC)) {
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
				/**/
		}

	}

	if (isset($_POST["sendAlcanceId"])) {
		
		$idAlcance=$_POST["sendAlcanceId"];
		$participante=$_POST["sendPaticipanteId"];
		$estadoAlcPar=1;
		$planId=$_POST["sendPlaId"];

		for ($i=0; $i < count($participante); $i++) { 

			$consulta="INSERT INTO alcances_has_cp_participantes (idAlcance, idParticipante, estadoAlcPar)
			VALUES (:idAlcance, :idParticipante, :estadoAlcPar)";
			$resultado=$conexion->prepare($consulta);
			$saber=$resultado->execute(array(
				':idAlcance' => $idAlcance,
				':idParticipante' => $participante[$i],
				':estadoAlcPar' => $estadoAlcPar));

		}
		if ($saber==true) {

			
			echo '<ol id="lista-historial" style="padding-left:15px;" class="lista-historial">';
			$consulta_list="SELECT * FROM alcances_has_cp_participantes
			INNER JOIN participantes ON alcances_has_cp_participantes.idParticipante = participantes.idParticipante
			WHERE alcances_has_cp_participantes.idAlcance = :idAlcance";
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
