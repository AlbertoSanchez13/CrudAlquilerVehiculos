<?php

namespace app\controllers;

use app\models\mainModel;

/*----------  Controlador registrar usuario  ----------*/

/* aqui userController hereda de mainModel */

class userController extends mainModel
{
    /* controlador para registros de usuarios, usado en el archivo usuarioAjax */
    public function registrarUsuarioControlador()
    {

        # Almacenando Datos #
        $nombre = $this->limpiarCadena($_POST['usuario_nombre']);
        $apellido = $this->limpiarCadena($_POST['usuario_apellido']);

        $usuario = $this->limpiarCadena($_POST['usuario_usuario']);
        $email = $this->limpiarCadena($_POST['usuario_email']);
        $clave1 = $this->limpiarCadena($_POST['usuario_clave_1']);
        $clave2 = $this->limpiarCadena($_POST['usuario_clave_2']);

        #Verificando Campos Obligatorios#
        if ($nombre == "" || $apellido == "" || $usuario == "" || $clave1 == "" || $clave2 == "") {

            $alerta = [

                /* Tipo para saber que tipo de alerta vamos a utilizar */
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];
            /* aqui devolvemos un array en formato json */
            return json_encode($alerta);
            /* exit(); --> para detener la ejecucion del script */
            exit();
        }

        /* Verificando integracion de los datos */
        if ($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)) {
            $alerta = [
                /* Tipo para saber que tipo de alerta vamos a utilizar */
                "tipo" => "simple",
                "titulo" => "Ocurrió un error inesperado",
                "texto" => "El APELLIDO no coincide con el formato solicitado",
                "icono" => "error"
            ];
            /* aqui devolvemos un array en formato json */
            return json_encode($alerta);
            /* exit(); --> para detener la ejecucion del script */
            exit();
        }

        if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El APELLIDO no coincide con el formato solicitado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }


        if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrió un error inesperado",
                "texto"=>"El USUARIO no coincide con el formato solicitado",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }

        

    }
}
