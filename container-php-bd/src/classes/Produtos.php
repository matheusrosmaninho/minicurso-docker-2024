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
            ->from('produtos')
            ->orderBy(['id ASC']);

        $stmt = $this->conexao->prepare($select->getStatement());
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletarProduto(int $id): bool
    {
        $delete = $this->queryFactory->newDelete();
        $delete
            ->from('produtos')
            ->where('id = :id')
            ->bindValue('id', $id);

        $stmt = $this->conexao->prepare($delete->getStatement());
        return $stmt->execute($delete->getBindValues());
    }

    public function getById(int $id) {
        $search = $this->queryFactory->newSelect();

        $search
            ->cols(['*'])
            ->from('produtos')
            ->where('id = :id')
            ->bindValue('id', $id);

        $stmt = $this->conexao->prepare($search->getStatement());
        $stmt->execute($search->getBindValues());
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarProduto(int $id, string $nome, float $valor): bool
    {
        $update = $this->queryFactory->newUpdate();
        $update
            ->table('produtos')
            ->cols([
                'nome' => $nome,
                'valor' => $valor
            ])
            ->where('id = :id')
            ->bindValue('id', $id);

        $stmt = $this->conexao->prepare($update->getStatement());
        return $stmt->execute($update->getBindValues());
    }
}