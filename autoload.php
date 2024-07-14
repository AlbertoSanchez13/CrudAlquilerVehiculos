<?php
    //https://diego.com.es/autoload-en-php  
    //Carga de clases o de los archivos que contienen todo el codigo de las clases automaticamente

    // echo __DIR__; --> para pruebas
    // esta fucion contiene el nombre de la clase
    // por medio de la variable $clase --> obtenemos el nombre de la clase, con todo el namespace --> nombre del espacio
    // soporte para espacios de nombres //https://www.php.net/manual/en/function.spl-autoload-register
    spl_autoload_register(function($clase){
        // codigo del autoload
        
        $archivo=__DIR__."/".$clase.".php"; // --> esta es la ruta que contiene el codigo de la clase 
        $archivo=str_replace("\\","/",$archivo); // esta linea es para evitar errores en sevidores linux
        
        //si el archivo existe en nuestro sistema, pues que lo incluya
        if(is_file($archivo)) {
            require_once $archivo;
        }
    
    });