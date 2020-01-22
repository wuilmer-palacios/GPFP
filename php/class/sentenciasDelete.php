<?php

	include('../conexion.php');
	$conexion= new Conexion();
	$conexion->exec("set names utf8");
	$conexion->exec("set names utf8");

	if (isset($_POST["sendIdParticipante"])) {
		
		$idAlcance=$_POST["sendIdAlcance"];
		$idParticipante=$_POST["sendIdParticipante"];

		$sentencia_delete
	}

?>