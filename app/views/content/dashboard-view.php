<div class="container is-fluid">
	<h1 class="title">Home</h1>
	<div class="columns is-flex is-justify-content-center">
		<figure class="image is-128x128">
			<img class="is-rounded" src="<?php echo APP_URL; ?>app/views/fotos/usuario.png">
		</figure>
	</div>
	<div class="columns is-flex is-justify-content-center">
		<h2 class="subtitle">¡Bienvenido <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?>!</h2>
	</div>
</div>