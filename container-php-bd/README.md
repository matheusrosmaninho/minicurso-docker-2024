# Container php

Aplicação de exemplo em docker

## Tecnologias

* Docker
* php
* postgres

## Antes de começar

1. Tenha o docker instalado em sua máquina (compose também)
2. Crie o arquivo `.env` com base no `.env.modelo` e ajuste o necessário
3. Crie o arquivo `src/.env` com base no `src/.env.modelo` e ajuste o necessário

## Desenvolvendo

1. Inicie o container
    ```
    docker compose up -d
    ```
2. Entre no container e execute `composer install`