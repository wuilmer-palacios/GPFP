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

	/*-----------------------------------------------------------------------------------------*/

	/*EN ESTE TROZO DE CODIGO RECIBE ID DE PARTICIPANTE Y ID DE ALCANCE Y COMPRUEBA SI YA EXISTE ESTE REGISTRO*/

	if (isset($_POST["alcanceId"])) {
		$idAlcance=$_POST["alcanceId"];
		$idParticipante=$_POST["participanteId"];

		$consulta="SELECT count(*) FROM alcances_has_cp_participantes
		WHERE idAlcance=$idAlcance AND idParticipante=$idParticipante";
		$resultado=$conexion->query($consulta);
		$numRow=$resultado->fetchColumn();
		echo $numRow;
	}

	if (isset($_POST["sendusuario"]) && isset($_POST["sendclave"])) {
		
		$usuario=$_POST["sendusuario"];
		$clave=$_POST["sendclave"];

		$consulta="SELECT count(*) FROM usuarios
		WHERE usuario = '$usuario' AND clave = '$clave'";
		$resultado=$conexion->query($consulta);
		$numRow=$resultado->fetchColumn();
		$numRow;

		if ($numRow=="1") {
			$consultaResponsable="SELECT * FROM usuarios
			INNER JOIN responsables ON responsables.idResponsable = usuarios.responsableUsuario
			WHERE usuarios.usuario = '$usuario' AND usuarios.clave = '$clave'";
			$resultadoResponsable=$conexion->prepare($consultaResponsable);
			$resultadoResponsable->execute();

			while ($row=$resultadoResponsable->fetch(PDO::FETCH_ASSOC)) {
				session_start();
				$_SESSION["responsable"]=$row["primerNombre"]." ".$row["primerApellido"];
				$_SESSION["idResponsable"]=$row["idResponsable"];
				$_SESSION["tipoUser"]=$row["tipoUser"];
				echo "1";
			}
		}
	}
?>