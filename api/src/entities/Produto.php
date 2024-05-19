<?php
namespace App\Entities;

use Ramsey\Uuid\Rfc4122\UuidV4;

class Produto implements \JsonSerializable
{
    private string $id;
    private string $nome;
    private float $valor;

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'valor' => $this->valor
        ];
    }
}