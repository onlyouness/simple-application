<?php
namespace Hp\Phpexe\App\Database;

use PDO;
use PDOException;

class Db
{
    public static ?PDO $connection = null;
    public static function getConnection(): PDO
    {
        try {
            if (self::$connection == null) {
                $dsn     = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
                $options = [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ];
                $conn = new PDO($dsn, DB_USER, DB_PWD, $options);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection = $conn;
            }
            return self::$connection;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }
}
