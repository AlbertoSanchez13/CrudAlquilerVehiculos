<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>

    <!-- Incluir Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <style>
        html,
        body {
            height: 100%;
        }

        .main-container {
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-container>.hero-body {
            height: auto;
            width: 100%;
            max-width: 400px;
            min-width: 300px;
        }

        .error-content {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="error-content">
            <section class="hero">
                <div class="hero-body">
                    <p class="title is-1">Error 404</p>
                    <p class="subtitle is-3">Página no encontrada</p>
                    <a href="<?php echo APP_URL; ?>" class="button is-primary">Volver al inicio</a>
                </div>
            </section>
        </div>
    </div>
</body>

</html>