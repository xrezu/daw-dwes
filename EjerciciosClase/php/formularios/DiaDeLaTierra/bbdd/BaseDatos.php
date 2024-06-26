<?php

/*

Clase para facilitar las conexiones y consultas a bases de datos

Por Jorge Dueñas Lerín

*/


class BaseDatos {

    private $conexion = null;
    private $sentencia = null;
    private $executed = false;

    /*
        Patrón Singletone para poder usar la clase en proyectos más grandes
    */

    private static $instanciaUnica = null;

    const FETCH_TODOS = 'todos';
    const FETCH_FILA = 'fila';
    const FETCH_COLUMNA = 'columna';

    private function __construct() { } // Solo se puede crear desde el método obtenerInstancia

    public static function obtenerInstancia() {
        if (self::$instanciaUnica == null)
        {
            self::$instanciaUnica = new BaseDatos();
        }

        return self::$instanciaUnica;
    }

    function inicializa(
        $basedatos = 'earth_day',// Nombre debe ser especificado O el archivo si es SQLite         
        $usuario  = 'root', // Ignorado si es SQLite
        $pass     = '1234', // Ignorado si es SQLite
        $motor    = 'mysql',
        $serverIp = 'localhost',
        $charset  = 'utf8mb4',
        $options  = null
    ) {
        if($motor != "sqlite") {
            $cadenaConexion = "$motor:host=$serverIp;dbname=$basedatos;charset=$charset";
        } else {
            $cadenaConexion = "$motor:$basedatos";
        }

        if($options == null){
            $options = [
              PDO::ATTR_EMULATE_PREPARES   => false, // La preparación de las consultas no es simulada
                                                     // más lento pero más seguro
              PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Cuando se produce un error
                                                                      // salta una excepción
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Cuando traemos datos lo hacemos como array asociativo
            ];
        }

        try {
            if($motor != "sqlite") {
            $this->conexion = new PDO($cadenaConexion, $usuario, $pass, $options);
        } else {
            $this->conexion = new PDO($cadenaConexion, null, null, $options);
        }
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit('No ha sido posible la conexión');
        }
    }

    /*
    Permite ejecutar una consulta preparada con parámetros posicionales.
        Parámetros
            1º SQL
            2º ... parámetros o array con parámetros
    */
    function ejecuta(string $sql, ...$parametros) {
        $this->sentencia = $this->conexion->prepare($sql);

        if($parametros == null){
            $this->executed = $this->sentencia->execute();
            return;
        }

        if($parametros != null && is_array($parametros[0])) {
            $parametros = $parametros[0]; // Si nos pasan un array lo usamos como parámetro
        }

        $this->executed = $this->sentencia->execute($parametros);
    }

    // Si no se proporciona ningun parametro al llamar a la función hará un fetchAll   
    public function obtenDatos($tipo = self::FETCH_TODOS) {
        switch ($tipo) {
            case self::FETCH_TODOS:
                return $this->sentencia->fetchAll();
            case self::FETCH_FILA:
                return $this->sentencia->fetch();
            case self::FETCH_COLUMNA:
                return $this->sentencia->fetchColumn();
            default:
                throw new InvalidArgumentException("Parametro introducido no valido: $tipo");
        }
    }

    function getLastId(){
        return $this->conexion->lastInsertId();
    }

    function getExecuted(){
        return $this->executed;
    }

    function __destruct(){
        $this->conexion = null;
    }
}
?>