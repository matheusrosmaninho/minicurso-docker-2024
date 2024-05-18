<?php
namespace App\Models;

use Aura\SqlQuery\QueryFactory;
use PDO;

require_once __DIR__ . '/../vendor/autoload.php';

class Produto
{
    private QueryFactory $queryFactory;
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->queryFactory = new QueryFactory('pgsql');
        $this->connection = $connection;
    }

    public function getAll(int $pagina = 1, int $limite = 10): array
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from('produtos')
            ->orderBy(['nome']);

        $sth = $this->connection->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, \App\Entities\Produto::class);
        return $sth->fetchAll();
    }
}