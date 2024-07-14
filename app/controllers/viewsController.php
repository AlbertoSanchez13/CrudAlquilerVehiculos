<?php

namespace app\controllers;

use app\models\viewsModel;

class viewsController extends viewsModel
{

    /*---------- Controlador obtener vistas ----------*/
    public function obtenerVistasControlador($vista)
    {

        //validamos si esta vista tiene un texto predefinido es decir que no venga vacio
        // si no viene vacia es que si definimos el nombre de la vista
        if ($vista != "") {
            //this--> para acceder a ese metodo
            $respuesta = $this->obtenerVistasModelo($vista);
        } else {
            /* caso contrario cargamos el login */
            $respuesta = "login";
        }
        return $respuesta;
    }
}