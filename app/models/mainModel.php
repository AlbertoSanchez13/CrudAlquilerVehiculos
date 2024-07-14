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
    /*----------  Funcion conectar a BD  ----------*/
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
    /*----------  Funcion ejecutar consultas  ----------*/
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
    /*----------  Funcion limpiar cadenas  ----------*/
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

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);


        foreach ($palabras as $palabra) {
            $cadena = str_ireplace($palabra, "", $cadena);
        }

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        return $cadena;
    }

    //modelo
    /*---------- Funcion verificar datos (expresion regular) ----------*/
    protected function verificarDatos($filtro, $cadena)
    {
        /* "[a-zA-Z0-9$@.-]{7,100}" */
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }




    /*----------  Funcion para ejecutar una consulta INSERT preparada  ----------*/
    /*modelo para guardar o insertar datos */
    protected function guardarDatos($tabla, $datos)
    {
        $query = "INSERT INTO $tabla (";

        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"];
            $C++;
        }

        $query .= ") VALUES(";

        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_marcador"];
            $C++;
        }

        $query .= ")";

        // preparamos la consulta
        /* Metodo prepare() de la clase PDO para preparar una consulta SQL. La consulta sql
        contiene marcadores de párametros con nombres (:name) */
        $sql = $this->conectar()->prepare($query);

        foreach ($datos as $clave) {
            /* bindParam() --> metodo que vincula o sustituye de la consulta SQL 
            un marcador(:name) con el valor real de una variable PHP */
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
        }
        /* execute() Metodo que ejecuta una consulta SQL preparada */
        $sql->execute();
        /* devolvemos el valor de la variable $sql, para saber en el controlador
        si hicimos o no la insercion de datos */
        return $sql;
    }



    /*---------- Funcion seleccionar datos ----------*/
    public function seleccionarDatos($tipo, $tabla, $campo, $id)
    {
        //limpiando cadenas
        $tipo = $this->limpiarCadena($tipo);
        $tabla = $this->limpiarCadena($tabla);
        $campo = $this->limpiarCadena($campo);
        $id = $this->limpiarCadena($id);

        if ($tipo == "Unico") {
            /*cuando el valor sea "Unico" en el paramerto $tipo, realizamos una seleccion de datos para un usuario en especifico*/
            //le pasamos una consulta
            $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo=:ID");
            /* cambiamos ese marcador por su valor real :ID->$id */
            $sql->bindParam(":ID", $id);
        } elseif ($tipo == "Normal") {
            $sql = $this->conectar()->prepare("SELECT $campo  FROM $tabla");
            $sql->execute();
            return $sql;
        }
    }


    
}







// https://www.php.net/manual/es/pdo.connections.php
// https://www.php.net/manual/es/function.trim.php
// https://www.php.net/manual/es/function.stripslashes.php
// https://www.php.net/manual/es/function.str-ireplace.php
// https://www.php.net/manual/es/function.preg-match.php

// https://www.php.net/manual/es/pdo.prepare.php
// https://www.php.net/manual/es/pdostatement.bindparam.php
// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado 
// https://www.php.net/manual/es/pdostatement.execute.php