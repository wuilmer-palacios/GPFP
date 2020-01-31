<?php
	if (isset($_POST["sendClose"])) {

		session_start();
		if (session_destroy()) {
		
		echo "1";
		}
		else {
		echo "Error al destruir la sesión";
		}

	}
?>	