<?php
namespace App\Classes;
use PDO;

class Connection
{
    public static function getConnection(string $host, string $user, string $password, string $database): PDO
    {
        try {
            $connection = new PDO("pgsql:host=$host;dbname=$database", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die;
        }
    }
}