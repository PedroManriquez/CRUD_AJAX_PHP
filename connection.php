<?php
/* Clase que permite conectarnos a la BD*/
// Clase Conexión extiende de la clase de php mysqli
class ConnectionDB extends mysqli {
    //Constructor de la clase
    public function __construct(){
        // Requerimos el constructor de la clase padre (mysqli)
        /* Enviamos por parámetros la dirección del servidor, 
        nombre de usuario, contraseña y nombre base de datos.*/
        parent::__construct('localhost','root','1234','crudphp');
        //Indicamos la codificación de caracteres con la que vamos a trabajar
        $this->query("SET NAMES 'utf8';");
        /* Verificamos el estado de la conexión.
        connect_errno nos devuelve el código de error de la última llamada (die).
        PHP permite declarar un if de una manera más compacta de la siguiente manera:
        <expresión1> ? <expresión2> : <expresión3>;
        Si la expresión1 se evalúa a true, devolverá la evaluación de la expresión2. Si se evalúa a false, devolverá la evaluación de la expresión3.*/
        $this->connect_errno ? die('Error con la conexion') : $x = 'conectado!';
        //echo $x;
        //Destruimos la variable "$x"
        unset($x);
    }

    /* Creamos la función "recorrer" que nos va 
    a permitir recorrer la base de datos y obtener las 
    filas de resultados como un array asociativo.*/
    public function recorrer($y){
        /*La función mysqli_fetch_array() obtiene una fila de resultados como un array asociativo, numérico, o ambos.*/
        return mysqli_fetch_array($y);
    }

    /* Creamos la función "rows" que va a 
    permitir devolver la cantidad de datos de un select*/
    public function rows($y){
        /* La función mysqli_num_rows() obtiene el número de filas de un resultado.*/
        return mysqli_num_rows($y);
    }
}
?>