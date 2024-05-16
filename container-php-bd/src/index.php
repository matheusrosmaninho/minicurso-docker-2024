<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/conexao.php";
require_once __DIR__ . "/classes/Produtos.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbUser = $_ENV['POSTGRES_USER'];
$dbName = $_ENV['POSTGRES_DB'];
$dbPassword = $_ENV['POSTGRES_PASSWORD'];
$dbHost = $_ENV['POSTGRES_HOST'];
$message = '';

$conexao = connect($dbHost, $dbName, $dbUser, $dbPassword);
$objPedidos = new Produtos($conexao);

$produto = [];

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $produto = $objPedidos->getById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_GET['id'])) {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];

    $id = $objPedidos->inserirProduto($nome, $valor);
    $message = "Produto inserido com sucesso";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];

    $objPedidos->atualizarProduto($id, $nome, $valor);
    $message = "Produto atualizado com sucesso";
    $produto = [];
}

$produtos = $objPedidos->listarProdutos();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
$twig = new \Twig\Environment($loader);
echo $twig->render('index.html', [
    'produtos' => $produtos,
    'message' => $message,
    'produto' => $produto,
]);