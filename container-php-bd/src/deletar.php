<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/classes/Produtos.php';

$body = file_get_contents('php://input');
parse_str($body, $data);

if(empty($data)) {
    http_response_code(412);
    echo json_encode(['error' => 'Corpo da mensagem não informado.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$id = $data['id'];

if (trim($id) === "") {
    http_response_code(412);
    echo json_encode(['error' => 'ID não informado'], JSON_UNESCAPED_UNICODE);
    exit;
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbUser = $_ENV['POSTGRES_USER'];
$dbName = $_ENV['POSTGRES_DB'];
$dbPassword = $_ENV['POSTGRES_PASSWORD'];
$dbHost = $_ENV['POSTGRES_HOST'];

$conexao = connect($dbHost, $dbName, $dbUser, $dbPassword);

$objProdutos = new Produtos($conexao);

$produto = $objProdutos->getById($id);

if (empty($produto)) {
    http_response_code(404);
    echo json_encode(['error' => 'Produto não encontrado'], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($objProdutos->deletarProduto($id)) {
    http_response_code(200);
    echo json_encode(['message' => 'Produto deletado com sucesso'], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(500);
echo json_encode(['error' => 'Erro ao deletar produto'], JSON_UNESCAPED_UNICODE);
exit;