<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controller\ProdutoController;
use App\Classes\Connection;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add routes
$app->get('/produtos', function (Request $request, Response $response) {
    $objProdutoController = new ProdutoController();

    $produtos = $objProdutoController->index();
    $response = $response->withHeader('Content-Type', 'application/json');
    $response->getBody()->write(json_encode($produtos));
    return $response;
});

$app->post('/produtos', function (Request $request, Response $response) {
    $objProdutoController = new ProdutoController();

    $produto = $objProdutoController->store($request->getParsedBody());
    $response = $response->withHeader('Content-Type', 'application/json');
    $response = $response->withStatus(201);
    $response->getBody()->write(json_encode($produto));
    return $response;
});

$app->run();