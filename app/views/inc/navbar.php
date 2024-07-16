<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> -->
</head>

<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard/">
                <img src="<?php echo APP_URL; ?>app/views/img/car_logo.png" alt="Logo" width="40" height="40">
            </a>
            <div class="navbar-burger" data-target="navbarExampleTransparentExample">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="navbarExampleTransparentExample" class="navbar-menu">

            <div class="navbar-start">
                <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard/">
                    Dashboard
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="">
                        Usuarios
                    </a>
                    <div class="navbar-dropdown is-boxed">

                        <a class="navbar-item" href="<?php echo APP_URL; ?>userNew/">
                            Nuevo
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>userList/">
                            Lista
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL; ?>userSearch/">
                            Buscar
                        </a>

                        <a class="navbar-item" href="<?php echo APP_URL; ?> carList/">
                            Lista de Autos
                        </a>

                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        ** <?php echo $_SESSION['usuario']; ?> **
                    </a>
                    <div class="navbar-dropdown is-boxed">

                        <a class="navbar-item" href="<?php echo APP_URL . "userUpdate/" . $_SESSION['id'] . "/"; ?>">
                            Mi cuenta
                        </a>
                        <a class="navbar-item" href="<?php echo APP_URL . "userPhoto/" . $_SESSION['id'] . "/"; ?>">
                            Mi foto
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="<?php echo APP_URL . "logOut/"; ?>" id="btn_exit">
                            Salir
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </nav>
</body>

</html>