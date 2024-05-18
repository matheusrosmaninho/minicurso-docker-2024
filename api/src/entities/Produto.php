<?php
namespace App\Entities;

class Produto implements \JsonSerializable {
    private int $id;
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