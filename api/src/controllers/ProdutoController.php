<?php
namespace App\Controller;
use App\Classes\Connection;

class ProdutoController
{
    public function index(int $pagina = 1): array
    {
        $connection = Connection::getConnection(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE']
        );
        $objProduto = new \App\Models\Produto($connection);
        return $objProduto->getAll($pagina);
    }
}