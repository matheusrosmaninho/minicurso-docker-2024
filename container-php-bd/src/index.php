<?php
require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbUser = $_ENV['POSTGRES_USER'];
$dbName = $_ENV['POSTGRES_DB'];
$dbPassword = $_ENV['POSTGRES_PASSWORD'];
$dbHost = $_ENV['POSTGRES_HOST'];

function connect($dbHost, $dbName, $dbUser, $dbPassword): PDO {
    try {
        $dsn = "pgsql:host=$dbHost;port=5432;dbname=$dbName;";
        return new PDO($dsn, $dbUser, $dbPassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch(PDOException $e) {
        die($e->getMessage());
    }
}

$conexao = connect($dbHost, $dbName, $dbUser, $dbPassword);

$faker = Faker\Factory::create();

$sql = 'insert into pedidos(nome, valor) values(:nome, :valor)';
$stmt = $conexao->prepare($sql);

$stmt->bindValue(':nome', $faker->name);
$stmt->bindValue(':valor', $faker->randomFloat(2, 10, 1000));
$stmt->execute();
$id = $conexao->lastInsertId();

print_r($id);