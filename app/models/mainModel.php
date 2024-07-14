<?php

// namespace es la ruta donde se encuentra mis archivos Models
namespace app\models;

use \PDO;

// constante __DIR__ --> esta devuelve la ruta absoluta de donde se encuentra el archivo actualmente
if (file_exists(__DIR__ . "/../../config/server.php")) {
    require_once __DIR__ . "/../../config/server.php";
}

class mainModel
{
    // estas variables solo son accesibles dentro de la misma clase por el modificador de acceso private
    private $server = DB_SERVER;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;

    //funcion para conectar a la base de datos
    //protected --> solo se va poder usar en esta clase y en las clases que heredan
    protected function conectar()
    {
        //conexion a la base de datos
        $conexion = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->user, $this->pass);
        //metodo exec --> para ejecutar
        //aqui establecemos que vamos a usar caracteres UTF8 en la base de datos
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    //funcion para hacer consultas a la base de datos
    protected function ejecutarConsulta($consulta)
    {
        //con this accedemos a todas las funciones o variables de la clase
        //funcion prepare --> prepara una consulta para luego ejecutarla  
        $sql = $this->conectar()->prepare($consulta);
        //con esto ejecutamos la consulta
        $sql->execute();
        return $sql;
    }


    //funcion para evitar inyeccion sql /filtro
    public function limpiarCadena($cadena)
    {

        $palabras = [
            "<script>",
            "</script>",
            "<script src",
            "<script type=",
            "SELECT * FROM",
            "SELECT ",
            " SELECT ",
            "DELETE FROM",
            "INSERT INTO",
            "DROP TABLE",
            "DROP DATABASE",
            "TRUNCATE TABLE",
            "SHOW TABLES",
            "SHOW DATABASES",
            "<?php",
            "?>",
            "--",
            "^",
            "<",
            ">",
            "==",
            "=",
            ";",
            "::"
        ];

        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);


        foreach($palabras as $palabra){
            $cadena=str_ireplace($palabra, "", $cadena);
        }

        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        return $cadena;
    }
}

// https://www.php.net/manual/es/pdo.connections.php
// https://www.php.net/manual/es/function.trim.php
// https://www.php.net/manual/es/function.stripslashes.php
// https://www.php.net/manual/es/function.str-ireplace.php