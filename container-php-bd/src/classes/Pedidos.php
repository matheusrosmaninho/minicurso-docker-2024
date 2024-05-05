<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Aura\SqlQuery\QueryFactory;

class Pedidos
{
    private PDO|null $conexao;

    private $queryFactory;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
        $this->queryFactory = new QueryFactory('pgsql');
    }

    public function inserirPedido(string $nome, float $valor): int
    {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into('pedidos')
            ->cols([
                'nome' => $nome,
                'valor' => $valor
            ])
            ->bindValues([
                'nome' => $nome,
                'valor' => $valor
            ]);

        $stmt = $this->conexao->prepare($insert->getStatement());

        $stmt->execute($insert->getBindValues());
        return $this->conexao->lastInsertId();
    }
}