<?php

class Database
{
    private static $host = "kelvindb.mysql.database.azure.com";
    private static $dbname = "centrocapacitacion";
    private static $username = "kelvin"; 
    private static $password = "Holaquehace123*";
    private static $conexion = null;

    public static function getConexion()
    {
        if (self::$conexion === null) {
            try {

                $dsn = "sqlsrv:Server=" . self::$host . ";Database=" . self::$dbname;

                self::$conexion = new PDO($dsn, self::$username, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Error al conectar a Azure SQL: " . $e->getMessage());
            }
        }

        return self::$conexion;
    }

    public static function closeConexion()
    {
        self::$conexion = null;
    }
}
