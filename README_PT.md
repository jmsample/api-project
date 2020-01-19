# api-project - Gabriel Anhaia
[![CircleCI](https://circleci.com/gh/gabrielanhaia/api-project/tree/master.svg?style=svg)](https://circleci.com/gh/gabrielanhaia/api-project/tree/master)

[PORTUGUESE VERSION](www.google.com)

## Description

Implementação da integração com a API do jornal com o objetivo de listar os artigos disponíveis compartilhados fazendo uso do framework. O Objetivo foi construir uma solução fazendo uso da orientação a objetos, e seguindo os principios de SOLID e aplicando padrões de projeto que fizeram sentido no projeto.

### CI

O Projeto foi configurado no Circle CI para rodar os testes unitários sempre que sofrer uma atualização.

### Technologies

- PHP 7.3
- Sample Framework
- PHPUnit
- Circle CI
- Docker

### Padrões de projetos usados
- Simple Factory
- Factory Method
- Abtract Factory
- Strategy

### .ENV

Antes de rodar o projeto é necessário copiar o arquivo *.env.example* para *.env* e trocar as variáveis de ambiente a baixo.

DEMO_MODE=false
API_JOURNAL_USERNAME=USERNAME_HERE
API_JOURNAL_PASSWORD=PASSWORD_HERE
API_JOURNAL_BASE_URL=https://api.thejournal.ie/v3/sample/

### Running the tests

Para todar os testes unitários (PHPUnit) você pode configuar ele em sua IDE ou apenas abrir a pasta principal do projeto com o terminal e rodar o seguinte comando:
`php vendor/bin/phpunit`

