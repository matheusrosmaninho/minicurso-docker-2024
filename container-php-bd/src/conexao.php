<?php

function connect($dbHost, $dbName, $dbUser, $dbPassword): PDO {
    try {
        $dsn = "pgsql:host=$dbHost;port=5432;dbname=$dbName;";
        return new PDO($dsn, $dbUser, $dbPassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch(PDOException $e) {
        die($e->getMessage());
    }
}