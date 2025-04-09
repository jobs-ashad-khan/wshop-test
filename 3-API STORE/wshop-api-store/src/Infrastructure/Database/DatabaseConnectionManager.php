<?php

namespace App\Infrastructure\Database;

class DatabaseConnectionManager
{
    private static ?DatabaseConnectionInterface $connection = null;

    private function __construct() {}

    public static function getConnection(): DatabaseConnectionInterface
    {
        if (self::$connection === null) {
            $pdo = new \PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            self::$connection = new PDODatabaseConnection($pdo);
        }

        return self::$connection;
    }
}