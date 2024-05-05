<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/conexao.php";
require_once __DIR__ . "/classes/Pedidos.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbUser = $_ENV['POSTGRES_USER'];
$dbName = $_ENV['POSTGRES_DB'];
$dbPassword = $_ENV['POSTGRES_PASSWORD'];
$dbHost = $_ENV['POSTGRES_HOST'];

$conexao = connect($dbHost, $dbName, $dbUser, $dbPassword);

$objPedidos = new Pedidos($conexao);
$faker = Faker\Factory::create();

$id = $objPedidos->inserirPedido($faker->name, $faker->randomFloat(2, 10, 1000));

print_r($id);