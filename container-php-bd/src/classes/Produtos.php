<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Aura\SqlQuery\QueryFactory;

class Produtos
{
    private PDO|null $conexao;

    private $queryFactory;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
        $this->queryFactory = new QueryFactory('pgsql');
    }

    public function inserirProduto(string $nome, float $valor): int
    {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into('produtos')
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

    public function listarProdutos(): array
    {
        $select = $this->queryFactory->newSelect();
        $select
            ->cols(['*'])
            ->from('produtos');

        $stmt = $this->conexao->prepare($select->getStatement());
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}