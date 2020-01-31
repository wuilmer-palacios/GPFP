<!DOCTYPE html>
<html>
<head>
	<title>Progressa - Gestor de Proyectos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/icon.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css-my-style/style.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js_fun/my_functions.js" type="text/javascript"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div id="login-box" class="col-md-4 center-block">
				<hr>
				<label>Login</label>
				<br><br>
				<form>
					<input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
					<br>
					<input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
				</form>
				<br>
				<button class="btn btn-primary center-block" onclick="loginUsuario();">
					Iniciar
				</button>
				<hr>
			</div>
		</div>
	</div>
	
</body>
</html>