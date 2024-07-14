<?php

require_once "./config/app.php";
require_once "./autoload.php";
/*---------- Iniciando sesion ----------*/
require_once "./app/views/inc/session_start.php";

$url = isset($_GET['views']) ? explode("/", $_GET['views']) : ["login"];

use app\controllers\viewsController;

$viewsController = new viewsController();
$vista = $viewsController->obtenerVistasControlador($url[0]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "./app/views/inc/head.php"; ?>
</head>

<body>
    <?php
    if ($vista == "login" || $vista == "404") {
        //la variable $vista=archivo de la carpeta content
        require_once "./app/views/content/" . $vista . "-view.php";
    } else {
        require_once "./app/views/inc/navbar.php";
        require_once $vista;
    }
    require_once "./app/views/inc/script.php";
    ?>
</body>

</html>