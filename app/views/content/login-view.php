<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

	<style>
        html, body {
            height: 100%;
        }
        .main-container {
            height: 100%;
			width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
		.main-container > .login{
            height: auto;
            width: 100%;
            max-width: 400px;
            min-width: 300px;
        }
    </style>
</head>
<body>
<div class="main-container">

<form class="box login" action="" method="POST" autocomplete="off" >
	<h5 class="title is-5 has-text-centered is-uppercase">LOGIN</h5>

	<div class="field">
		<label class="label">Usuario</label>
		<div class="control">
			<input class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
		</div>
	</div>

	<div class="field">
		  <label class="label">Clave</label>
		  <div class="control">
			<input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
		  </div>
	</div>

	<p class="has-text-centered mb-4 mt-3">
		<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
	</p>

</form>
</div>

<!-- <?php
	if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
		$insLogin->iniciarSesionControlador();
	}
?> -->

</body>
</html>