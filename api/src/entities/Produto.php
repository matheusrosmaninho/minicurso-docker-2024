<?php
namespace App\Entities;

use Ramsey\Uuid\Rfc4122\UuidV4;

class Produto implements \JsonSerializable
{
    private string $id;
    private string $nome;
    private float $valor;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'valor' => $this->valor
        ];
    }
}