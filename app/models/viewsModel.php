<?php
//https://diego.com.es/namespaces-en-php
//https://diego.com.es/arrays-en-php
namespace app\models;

class viewsModel
{
    protected function obtenerVistasModelo($vista)
    {
        //array para manejo de urls permitidas
        $listaBlanca = [
            "dashboard",
            "log",
            "userNew",
            "userList",
            "userSearch",
            "userUpdate",
            "userPhoto",
            "logOut",
            "carList"

        ];

        //funcion in_array
        //validad si el nombre de la vista existe dentro del array --> devuelve true, caso contrario false
        if (in_array($vista, $listaBlanca)) {
            $ruta = "./app/views/content/" . $vista . "-view.php";
            // file_exists() para verificar la existencia del archivo.
            if (file_exists($ruta)) {
                $contenido = $ruta;
            } else {
                $contenido = "404";
            }
        } elseif ($vista == "login" || $vista == "index") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }

        return $contenido;
    }
}
